<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Recupera todos os usuários do banco de dados

        return view('admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $id = $request->input('user_id');

        $userFind = User::where('email', $email)->first();

        if ($userFind && !$id) {
            // Não é usuário novo e não existe esse usuário
            echo "Repetido";
        } else {
            if ($id) {
                // Atualizar usuário
                $user = User::where('id', $id)->first();
                if ($userFind) {
                    if ($userFind->email == $user->email) {
                        $user->name = $request->input('name');
                        $user->email = $request->input('email');
                        $user->save();
                        echo "Sucesso";
                    } else {
                        echo "Repetido 1";
                    }
                } else {
                    $user->name = $request->input('name');
                    $user->email = $request->input('email');
                    $user->save();
                    echo "Sucesso";
                }
            } else {
                // Criar novo usuário
                $user = new User;

                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->password = "123456";
                $user->save();
                echo "Sucesso";
            }
        }
    }
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        try {
            $user->delete();
            return response()->json(['message' => 'Usuário excluído com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir o usuário'], 500);
        }
    }

    public function updatePerfil(Request $request)
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        $password_old = $request->input('password_old');
        $password_new = $request->input('password_new');
        if (password_verify($password_old, $user->password)) {
            $user->password = $password_new;
            $user->save();
            return redirect()->route('home')->with('success', 'Senha alterada com sucesso.');;
        } else {
            return back()->withInput()->withErrors(['perfil' => 'Senha atual inválida']);
        }
    }
}
