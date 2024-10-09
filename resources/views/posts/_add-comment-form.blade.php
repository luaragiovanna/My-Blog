@auth
                        <x-panel>

                        
                        <form method="POST" action="/posts/{{$post->slug}}/comments">
                            @csrf
                            <header class="flex items-center">
                                <img src="https://i.pravatar.cc/60?u={{auth()->id()}}" alt="" width="40" height="60" class="rounded-full mb-2">
                                <h2 class="px-3">Wanna participate?</h2>

                            </header>

                            <div class=" mb-6 flex flex-col border-t border-gray-00 pt-6"  >
                                <textarea  style="padding-top: 10px; height: 50px;" name="body" class="w-full text-sm px-10" cols="20" rows="5" placeholder="Say something here!"
                                required ></textarea>
                                @error('body')
                                <span class="text-sm text-red-400">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl self-end" >Post</button>
                            </div>
                        </form>
                    </x-panel>
                    @else
                        <p>
                            <a href="/register" class="hover:underline">Register</a> or <a href="/login" class="hover:underline">Log in to participate</a>
                        </p>
                    @endauth