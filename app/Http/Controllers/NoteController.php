<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteController extends Controller
{

    public function index(): JsonResource
    {
        //json(params) 1st param is the data to be returned, 2nd param is the status code, 3rd param is the headers
        //return response()->json(Note::all(), 200);
        return NoteResource::collection(Note::all());
    }

    public function store(NoteRequest $request): JsonResponse
    {
        $note = Note::create($request->all());
        // 201 status code means that a resource has been created
        return response()->json([
            'success' => true,
            'data' => new NoteResource($note)
        ], 201);
    }

    public function show(string $id): JsonResource
    {
        $note = Note::find($id);
        return new NoteResource($note);
    }

    public function update(NoteRequest $request, string $id): JsonResponse
    {
        $note = Note::find($id);
        $note->title = $request->title;
        $note->description = $request->description;
        $note->save();

        return response()->json([
            'success' => true,
            'data' => new NoteResource($note)
        ], 200);

    }

    public function destroy(string $id): JsonResponse
    {
        $note = Note::destroy($id);

        return response()->json([
            'success' => true
        ], 200);
    }
}
