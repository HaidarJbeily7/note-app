<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user() == null)
            return  redirect('/login');
        $user_id = Auth::user()->id;
        $notes = Note::where('user_id', $user_id)->paginate(6);

        return  view('notes.index', ['data' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string',
            'content' => 'required|string',
            'type' => 'required|string|in:on date,urgent,normal',
        ]);
        if($validator->fails())
        {
            return redirect()->back()
                        ->withErrsors($validator)
                        ->withInput();
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

        $note = Note::create($data);
        return  redirect(route('notes.index'))->with('success', 'Creating Note Completed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::where('id', $id)->first()->toArray();

        return view('notes.show', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::where('id', $id)->first()->toArray();
        return view('notes.edit', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),[
            'title' => 'string',
            'content' => 'string',
            'type' => 'string|in:on date,urgent,normal',
        ]);
        if($validator->fails())
        {
            return redirect()->back()
                        ->withErrsors($validator)
                        ->withInput();
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

        $note = Note::where('id', $id)->where('user_id', Auth::user()->id)->update($data);
        return  redirect(route('notes.index'))->with('success', 'Updating Note Completed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Note::where('id', $id)->first()->delete();
        return redirect(route('notes.index'))->with('alert', 'Delete Note Completed');
    }
}
