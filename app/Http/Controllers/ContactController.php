<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // List all contacts
    public function index(Request $request)
    {
        $contacts = Contact::query();

        // Search functionality
        if ($request->has('search')) {
            $contacts = $contacts->where('name', 'like', '%'.$request->search.'%')
                                ->orWhere('email', 'like', '%'.$request->search.'%');
        }

        // Sorting functionality
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $contacts = $contacts->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $contacts = $contacts->orderBy('name', 'desc');
                    break;
                case 'created_at_asc':
                    $contacts = $contacts->orderBy('created_at', 'asc');
                    break;
                case 'created_at_desc':
                    $contacts = $contacts->orderBy('created_at', 'desc');
                    break;
                default:
                    $contacts = $contacts->orderBy('name', 'asc');
            }
        } else {
            $contacts = $contacts->orderBy('name', 'asc'); // Default sorting
        }

        $contacts = $contacts->paginate(10);

        return view('contacts.index', compact('contacts'));
    }

    // Show the form to create a new contact
    public function create()
    {
        return view('contacts.create');
    }

    // Store a new contact
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:contacts,email',
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    // Show a specific contact
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    // Show the form to edit a contact
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    // Update a contact
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:contacts,email,'.$contact->id,
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    // Delete a contact
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
