

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="f_name" :value="__('First Name')" />
            <x-text-input id="f_name" class="block mt-1 w-full" type="text" name="f_name" :value="old('f_name')" required autofocus autocomplete="f_name" />
            <x-input-error :messages="$errors->get('f_name')" class="mt-2" />
        </div>
		 <!-- Last Name -->
		<div>
            <x-input-label for="l_name" :value="__('Last Name')" />
            <x-text-input id="l_name" class="block mt-1 w-full" type="text" name="l_name" :value="old('l_name')" required autofocus autocomplete="l_name" />
            <x-input-error :messages="$errors->get('l_name')" class="mt-2" />
        </div>
		
				 <!-- DoB -->
		<div>
			<x-input-label for="dob" :value="__('Date of Birth')" />
		 <input id="dob" type="date" class="border-gray-300 form-input rounded-md shadow-sm mt-1 block w-full" name="dob" required>

	   </div>
		
		 <!-- Gender -->
		 <div class="mt-4">
    <label for="gender" class="block font-medium text-sm text-gray-700">Gender</label>
    <select id="gender" name="gender" class="border-gray-300 form-select mt-1 block w-full">
        <option value="1">Male</option>
        <option value="2">Female</option>
        <option value="3">Other</option>
    </select>
</div>
		 


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

