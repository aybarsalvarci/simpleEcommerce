<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ])->validate();

        // upload image
        $imageName = str()->slug($input['name']) . '-' . uniqid() . '.' . $input['image']->getClientOriginalExtension();
        $input['image']->storeAs('public/images/users', $imageName);


        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'image' => '/storage/public/images/users/' . $imageName,
        ]);
    }
}
