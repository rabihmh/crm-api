<?php

namespace App\Http\Controllers;

use App\Crm\Customer\Models\Note;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoteController extends Controller
{
    public function notFound($msg = 'Not Found', $status = Response::HTTP_NOT_FOUND): \Illuminate\Http\JsonResponse
    {
        return response()->json(['status' => $msg], $status);
    }


    public function index(Request $request, $customer_id)
    {
        return Note::where('customer_id', $customer_id)->get();
    }

    public function show($id)

    {
        return Note::find($id) ?? $this->notFound();

    }

    public function store(Request $request, $customer_id)
    {
        $note = new Note();
        $note->note = $request->post('note');
        $note->customer_id = $customer_id;
        $note->save();
        return $note;
    }

    public function update(Request $request, $customer_id, $id)
    {
        $note = Note::find($id);
        if (!$note) {
            return $this->notFound();
        }
        if ($note->customer_id !== (int)$customer_id) {
            return $this->notFound('Invalid Data', Response::HTTP_BAD_REQUEST);
        }

        $note->note = $request->post('note');
        $note->save();
        return $note;
    }

    public function destroy($customer_id, $id)
    {
        $note = Note::find($id);
        if (!$note) {
            return $this->notFound();
        }
        if ($note->customer_id !== (int)$customer_id) {
            return $this->notFound('Invalid Data', Response::HTTP_BAD_REQUEST);
        }

        $note->delete();
        return \Illuminate\Support\Facades\Response::json(['status' => 'delete'], Response::HTTP_OK);
    }


}
