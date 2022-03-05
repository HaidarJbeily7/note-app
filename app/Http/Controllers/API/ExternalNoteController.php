<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\CustomResource;

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

    }

    public function update(Request $request)
    {

    }

    public function destroy(Request $request)
    {
        Note::where('user_id', Auth::user()->id)->where('id', $request->all()['id'])->delete();
        return $this->handleResponse([], 'Note has been deleted!', 204);
    }

}
