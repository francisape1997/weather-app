<?php

namespace App\Http\Controllers;

use App\Renderer\UserRenderer;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @param UserRenderer $userRenderer
     */
    public function __construct(
        private UserRenderer $userRenderer,
    ) {}

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $users = User::paginate(request()->query('per_page') ?? 50);

        $data = $this->userRenderer->renderList($users->toArray()['data']);

        return response()->json($data);
    }
}
