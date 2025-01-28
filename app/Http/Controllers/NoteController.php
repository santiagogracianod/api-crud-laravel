<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::all();
        // Return the notes as JSON
        //json(params) 1st param is the data to be returned, 2nd param is the status code, 3rd param is the headers
        return response()->json($notes, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(NoteRequest $request)
    {
        Note::create($request->all());
        // 201 status code means that a resource has been created
        return response()->json([
            'success' => true
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $note = Note::find($id);
        return response()->json($note, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, string $id)
    {
        $note = Note::find($id);
        $note->title = $request->title;
        $note->description = $request->description;
        $note->save();

        return response()->json([
            'success' => true
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Note::destroy($id);

        return response()->json([
            'success' => true
        ], 200);
    }
}
