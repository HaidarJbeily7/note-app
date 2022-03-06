<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\CustomResource;
use Illuminate\Support\Facades\Validator;

class ExternalNoteController extends BaseController
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $notes = Note::where('user_id', $user_id)->paginate(6);
        return $this->handleResponse(new CustomResource($notes), 'Notes fetched!');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string',
            'content' => 'required|string',
            'type' => 'required|string|in:on date,urgent,normal',
        ]);
        if($validator->fails())
        {
            return $this->handleError($validator->errors(), 'The given data is invalid', 422);
        }
        $data = $validator->validated();
        $data['user_id'] = Auth::user()->id;

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:2014',
                ]);
                $name = time().'_'.$validated['image']->getClientOriginalName();
                $validated['image']->storeAs('/public',$name);
                $data['image'] = $name;
            }
        }
        else{
            $data['image'] = null;
        }
        $note = Note::create($data);
        return $this->handleResponse(new CustomResource($note), 201);
    }

    public function update(Request $request, $id)
    {
        $note = Note::where('user_id', Auth::user()->id)->where('id', $id)->get();
        if(count($note)==0)
            return $this->handleError([], 'note not found!', 404);

        $validator = Validator::make($request->all(),[
            'title' => 'string',
            'content' => 'string',
            'type' => 'string|in:on date,urgent,normal',
        ]);
        if($validator->fails())
        {
            return $this->handleError($validator->errors(), 'The given data is invalid', 422);
        }
        $data = $validator->validated();
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:2014',
                ]);
                $name = time().'_'.$validated['image']->getClientOriginalName();
                $validated['image']->storeAs('/public',$name);
                $data['image'] = $name;
            }
        }
        $note = $note->update($data);
        return $this->handleResponse(new CustomResource($note), 200);
    }

    public function destroy($id)
    {
        $note = Note::where('user_id', Auth::user()->id)->where('id', $id);

        if($note->count() == 1){
            $note->delete();
            return $this->handleResponse([], 'Note has been deleted!', 204);
        }
        else{
            return $this->handleError('Not Found', 404);
        }
    }

}
