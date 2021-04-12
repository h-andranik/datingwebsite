<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    This is where you can update your user settings
                </div>

                <form action="/add/field" style="display: flex;flex-direction: column; width: 80%; margin: auto;"
                      method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="mt-4">
                        @if(isset($user->image))
                            <td>

                                <img style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;"
                                     src="{{ asset('uploads/'. $user->image) }}">
                            </td>
                        @else
                            <td>
                                <img style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;"
                                     src="{{ asset('uploads/7620.webp') }}">
                            </td>
                        @endif
                    </div>
                    <div class="mt-4">


                        <input type="file" placeholder="image" name="image"  />


                    </div>
                    <div class="mt-4">
                        <x-label for="state" value="State"/>


                            <x-input class="block mt-1 w-full" type="text" name="state" value="{{ $user->state }}"/>
                        @if ($errors->has('state'))

                            <h1 style="color: red;">{{ $errors->first('state') }}</h1>


                        @endif

                    </div>
                    <div class="mt-4">
                        <x-label for="city" value="City"/>


                        <x-input class="block mt-1 w-full" type="text" name="city" value="{{ $user->city }}"/>
                        @if ($errors->has('city'))

                            <h1 style="color: red;">{{ $errors->first('city') }}</h1>

                        @endif
                    </div>
                    <div class="mt-4">
                        <x-label for="country" value="Country"/>


                            <x-input class="block mt-1 w-full" type="text" id="inp"  name="country" value="{{ $user->country }}"/>
                        @if ($errors->has('country'))

                            <h1 style="color: red;">{{ $errors->first('country') }}</h1>


                        @endif
                    <ul id="ulforsearch">

                    </ul>
                    </div>

                    <div class="mt-4">
                        <x-label for="age" value="Age"/>


                            <x-input class="block mt-1 w-full" type="number" name="age"
                                     value="{{ $user->age }}"/>

                        @if ($errors->has('age'))

                            <h1 style="color: red;">{{ $errors->first('age') }}</h1>


                        @endif
                    </div>

                    <div class="mt-4">
                        <x-label for="gender" value="Gender"/>


                        @if($user->gender == "male")
                            <input type="radio" checked name="gender" value="male" class="mr-2">Male<br>
                            <input type="radio" name="gender" value="female" class=mr-2>Female<br>
                        @elseif($user->gender == "female")
                            <input type="radio" name="gender" value="male"> Male<br>
                            <input type="radio" checked name="gender" value="female"> Female<br>
                        @else
                            <input type="radio" name="gender" value="male"> Male<br>
                            <input type="radio" name="gender" value="female"> Female<br>
                        @endif

                    </div>
                    <div class="mt-4">
                        <x-label for="birthday" value="Birthday"/>
                            <x-input class="block mt-1 w-full" type="date" name="birthday" max="2021-12-31"
                                     min="1960-12-31" value="{{ $user->birthday }}"/>
                    </div>

                    <div class="mt-4">

                        <x-label for="astrology" value="Astrology"/>


                        @if(isset($user->astrology) && $user->astrology != "")
                            <select name="astrology">
                                <option>{{ $user->astrology }}</option>
                                @foreach($arr as $key => $values)
                                    <option>{{ $values }}</option>
                                @endforeach
                                <option></option>
                            </select>

                        @else
                            <select name="astrology">
                                <option></option>
                            @foreach($arr as $key => $values)
                                    <option>{{ $values }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <div class="mt-4">
                        <x-label for="about" value="Interests"/>
                        <?php $userInterests = []; ?>
                        @foreach ($user->interests as $inter)
                            <?php $userInterests[] = $inter->id;?>
                        @endforeach

                        @foreach($interests as $interest)

                            @if(in_array($interest->id, $userInterests))
                                <?php $checked = 'checked="checked"' ?>
                            @else
                                <?php $checked = ''?>
                            @endif
                            <input type="checkbox" name="interest_id[]" {{$checked}} value="{{ $interest->id }}">
                            <label for="interest_id"> {{ $interest->name }}</label>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <x-label for="about" value="About"/>
                        <x-input class="block mt-1 w-full" type="text" name="about" value="{{ $user->about }}"/>
                    </div>
                    <div class="mt-4">

                        <x-button class="mt-4" style="margin-bottom: 25px;">
                            Save
                        </x-button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
