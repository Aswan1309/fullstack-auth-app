<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Identifiants incorrects'], 401);
        }

        $user  = Auth::user();
        $token = $user->createToken('flutter-app')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => [
                'name'       => $user->name,
                'first_name' => $user->first_name ?? $user->name,
                'email'      => $user->email,
            ]
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('flutter-app')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => [
                'name'       => $user->name,
                'first_name' => $user->name,
                'email'      => $user->email,
            ]
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Déconnecté']);
    }

    public function dashboard(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'user' => [
                'name'       => $user->name,
                'first_name' => $user->first_name ?? $user->name,
                'email'      => $user->email,
            ],
            'stats' => [
                ['label' => 'Projets actifs',  'value' => '12',  'delta' => '+2 ce mois',    'up' => true],
                ['label' => 'Messages',         'value' => '48',  'delta' => '+7 non lus',    'up' => true],
                ['label' => 'Tâches',           'value' => '89%', 'delta' => '+5% semaine',   'up' => true],
                ['label' => 'Collaborateurs',   'value' => '24',  'delta' => 'Équipe active', 'up' => false],
            ],
            'activity' => [
                ['icon' => '🚀', 'label' => 'Projet Alpha lancé',               'time' => 'Il y a 2 heures'],
                ['icon' => '✅', 'label' => 'Tâche #42 complétée',              'time' => 'Il y a 5 heures'],
                ['icon' => '💬', 'label' => 'Nouveau commentaire sur Dashboard', 'time' => 'Hier'],
                ['icon' => '📊', 'label' => 'Rapport mensuel généré',           'time' => 'Il y a 2 jours'],
            ]
        ]);
    }
}