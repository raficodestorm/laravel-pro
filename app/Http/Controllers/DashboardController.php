<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index(Request $request)
  {
    $user = $request->user();

    // role-wise dashboard view
    $view = "pages.dashboard.{$user->role}";

    // if the view does not exist → fallback
    if (!view()->exists($view)) {
      $view = "pages.dashboard.user";
    }

    return view($view, ['user' => $user]);
  }
}
