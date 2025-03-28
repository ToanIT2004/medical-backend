<?php

// src/Middleware/CheckRoleMiddleware.php
namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleMiddleware
{
   public function handle(Request $request, Closure $next, ...$roles)
   {
      if (!auth()->check() || !auth()->user()->hasRole($roles)) {
         return response()->json([
            'status' => 'error',
            'message' => 'Bạn không có quyền truy cập',
            'errors' => [
               'permission' => 'Unauthorized access'
            ]
         ], 403);
      }

      return $next($request);
   }
}