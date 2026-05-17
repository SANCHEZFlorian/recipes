<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminReviewController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'avis');

        if ($tab === 'comments') {
            $data = Commentaire::with(['user', 'recette'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        } else {
            $data = Avis::with(['user', 'recette'])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        }

        return Inertia::render('Admin_reviews', [
            'data' => $data,
            'currentTab' => $tab
        ]);
    }

    public function destroyAvis($id)
    {
        $avis = Avis::findOrFail($id);
        $avis->delete();

        return redirect()->back()->with('success', 'L\'avis a été supprimé.');
    }

    public function destroyComment($id)
    {
        $comment = Commentaire::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Le commentaire a été supprimé.');
    }
}
