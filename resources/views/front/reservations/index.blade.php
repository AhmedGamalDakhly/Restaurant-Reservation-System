<x-guest-layout>
        <div class="container mx-auto">
            <div class="my-reservations  flex flex-col ">
                <div class="flex justify-center m-2 p-2">
                   My Reservations
                </div>
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table class="min-w-full">
                                <thead class="karam-elsham-bgcolor dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Date
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Table
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Guests
                                    </th>
                                    <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Meals
                                    </th>
                                    <th scope="col" class="relative py-3 px-6">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reservations as $reservation)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td
                                        class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $reservation->first_name }} {{ $reservation->last_name }}
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $reservation->res_date }}
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $reservation->table->name }} ({{$reservation->table->location}})
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        {{ $reservation->guest_number }}
                                    </td>
                                    <td
                                        class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                        @foreach ($reservation->activeMeals() as $meal)
                                            {{ $meal -> name}}
                                            <img class="w-full h-20" src="{{ Storage::url($meal->image) }}" alt="Image" />
                                        @endforeach
                                    </td>
                                        <td
                                            class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex space-x-2">
                                                <form
                                                    class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                    method="POST"
                                                    action="{{ route('reservations.destroy', $reservation->id) }}"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" value="delete">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-guest-layout>
