<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="font-extrabold  text-xl full-header">Meals</div>
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($meals as $meal)
                <a href="{{ route('meals.show', $meal->id) }}" class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <img class="w-full h-48" src="{{ Storage::url($meal->image) }}" alt="Image" />
                    <div class="px-6 py-4">
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                            {{ $meal->name }}</h4>
                        <p class="leading-normal text-gray-700">{{ $meal->description }}.</p>
                    </div>
                    <div class="flex items-center justify-between p-4">
                        <span class="text-xl text-green-600">${{ $meal->price }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-guest-layout>
