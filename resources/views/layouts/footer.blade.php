<footer class="bg-primary-green py-20">
    <div class="sm:grid grid-cols-3 w-4/5 pb-10 m-auto border-b-2 border-secondary-green">
        <!-- Pages Section -->
        <div>
            <h3 class="text-lg sm:font-bold text-light-beige">
                Pages
            </h3>

            <ul class="py-4 sm:text-sm pt-4 text-soft-green">
                <li class="pb-1">
                    <a href="/" class="hover:text-light-beige transition-colors">
                        Home
                    </a>
                </li>
                <li class="pb-1">
                    <a href="/blog" class="hover:text-light-beige transition-colors">
                        Blog
                    </a>
                </li>
                <li class="pb-1">
                    <a href="/about" class="hover:text-light-beige transition-colors">
                        About
                    </a>
                </li>
                <li class="pb-1">
                    <a href="/contact" class="hover:text-light-beige transition-colors">
                        Contact
                    </a>
                </li>
                <li class="pb-1">
                    <a href="/login" class="hover:text-light-beige transition-colors">
                        Login
                    </a>
                </li>
                <li class="pb-1">
                    <a href="/register" class="hover:text-light-beige transition-colors">
                        Register
                    </a>
                </li>
            </ul>
        </div>

        <!-- Find Us Section -->
        <div>
            <h3 class="text-lg sm:font-bold text-light-beige">
                Find Us
            </h3>

            <ul class="py-4 sm:text-sm pt-4 text-soft-green">
                <li class="pb-1">
                    <a href="/about" class="hover:text-light-beige transition-colors">
                        About Us
                    </a>
                </li>
                <li class="pb-1">
                    <a href="/contact" class="hover:text-light-beige transition-colors">
                        Contact
                    </a>
                </li>
                <li class="pb-1">
                    <p class="hover:text-light-beige transition-colors">
                        123 Greenway St, Gardenville, Dublin 2
                    </p>
                </li>
                <li class="pb-1">
                    <p class="hover:text-light-beige transition-colors">
                        contact@greenthumb.com
                    </p>
                </li>
                <li class="pb-1">
                    <p class="hover:text-light-beige transition-colors">
                        +1 (555) 123-4567
                    </p>
                </li>
            </ul>
        </div>

        <!-- Latest Posts Section -->
        <div>
            <h3 class="text-lg sm:font-bold text-light-beige">
                Latest Posts
            </h3>

            <ul class="py-4 sm:text-sm pt-4 text-soft-green">
                @forelse ($latestPosts as $post)
                    <li class="pb-1">
                        <a href="/blog/{{ $post->slug }}" class="hover:text-light-beige transition-colors">
                            {{ Str::limit($post->title, 50, '...') }}
                        </a>
                    </li>
                @empty
                    <li class="pb-1 text-soft-green">No recent posts</li>
                @endforelse
            </ul>
        </div>
    </div>
</footer>
