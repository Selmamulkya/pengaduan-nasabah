<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 

class ComplaintController extends Controller
{
    use AuthorizesRequests; 

    public function index()
    {
        if(auth()->user()->is_admin) {
            $complaints = Complaint::with('user')->latest()->get();
        } else {
            $complaints = auth()->user()->complaints()->latest()->get();
        }
        
        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);

    auth()->user()->complaints()->create($validated);

    return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil dibuat!');
}

    public function show(Complaint $complaint)
    {
        $this->authorize('view', $complaint);
        return view('complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint)
    {
        $this->authorize('update', $complaint);
        return view('complaints.edit', compact('complaint'));
    }

   public function update(Request $request, Complaint $complaint)
{
    $this->authorize('update', $complaint);
    
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'sometimes|required|in:pending,in_progress,resolved',
        'response' => 'nullable|string',
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);

    $complaint->update($validated);

    return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil diperbarui!');
}


    public function destroy(Complaint $complaint)
    {
        $this->authorize('delete', $complaint);
        $complaint->delete();
        return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil dihapus!');
    }

    public function updateStatus(Request $request, Complaint $complaint)
{
    $request->validate([
        'status' => 'required|string|in:pending,processing,resolved,rejected',
    ]);

    $complaint->status = $request->status;
    $complaint->save();

    return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
}

}