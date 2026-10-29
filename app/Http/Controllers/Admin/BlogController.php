<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display the Blog editor with pre-filled fields, along with blog management.
     */
    public function index(Request $request)
    {
        $allBlogs = Blog::orderBy('id', 'desc')->get();
        $categories = Blog::CATEGORIES;
        $blog = null;
        $isCreating = ($request->query('action') === 'create');

        // If specific blog requested via ?id=
        if ($request->filled('id')) {
            $blog = Blog::find($request->query('id'));
        }

        return view('admin.blogs.index', compact('blog', 'allBlogs', 'categories', 'isCreating'));
    }

    /**
     * Store a newly created blog post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'slug'             => ['nullable', 'string', 'max:255'],
            'category'         => ['required', 'string', 'in:News,Coming Soon,Real Estate'],
            'short_content'    => ['nullable', 'string'],
            'content'          => ['nullable', 'string'],
            'cover_image'      => ['nullable', 'string', 'max:500'],
            'cover_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,avif', 'max:5120'],
            'status'           => ['nullable', 'string', 'in:publish,draft'],
            'faq_q'            => ['nullable', 'array'],
            'faq_a'            => ['nullable', 'array'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords'    => ['nullable', 'string', 'max:500'],
        ]);

        $title = trim($validated['title']);
        $rawSlug = trim($request->input('slug') ?: $title);
        $slug = Str::slug($rawSlug);

        // Ensure unique slug
        $uniqueSlug = $slug;
        $count = 1;
        while (Blog::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $count;
            $count++;
        }

        // Handle Cover Image (700x500)
        $coverImage = $validated['cover_image'] ?? '/images/Hudayriyat-Island---Marsana-East-Beach---Sign---Sunset-2.jpg';
        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $uploadDir = public_path('images/blogs');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = time() . '_cover_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $coverImage = '/images/blogs/' . $filename;
        }

        // Parse FAQs
        $faqs = $this->parseFaqs($request);

        $status = $request->input('status', 'publish');
        $isPublished = ($status === 'publish');

        $blog = Blog::create([
            'title'            => $title,
            'slug'             => $uniqueSlug,
            'category'         => $validated['category'],
            'short_content'    => $request->input('short_content'),
            'content'          => $request->input('content'),
            'cover_image'      => $coverImage,
            'faqs'             => $faqs,
            'status'           => $status,
            'is_published'     => $isPublished,
            'author'           => $request->input('author', 'Hudayriyat Editorial'),
            'meta_title'       => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keywords'    => $request->input('meta_keywords'),
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully!');
    }

    /**
     * Show edit form for a specific blog.
     */
    public function edit(Blog $blog)
    {
        return redirect()->route('admin.blogs.index', ['id' => $blog->id]);
    }

    /**
     * Update the specified blog post.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'slug'             => ['nullable', 'string', 'max:255'],
            'category'         => ['required', 'string', 'in:News,Coming Soon,Real Estate'],
            'short_content'    => ['nullable', 'string'],
            'content'          => ['nullable', 'string'],
            'cover_image'      => ['nullable', 'string', 'max:500'],
            'cover_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,avif', 'max:5120'],
            'status'           => ['nullable', 'string', 'in:publish,draft'],
            'faq_q'            => ['nullable', 'array'],
            'faq_a'            => ['nullable', 'array'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords'    => ['nullable', 'string', 'max:500'],
        ]);

        $title = trim($validated['title']);
        $rawSlug = trim($request->input('slug') ?: $title);
        $slug = Str::slug($rawSlug);

        // Ensure unique slug excluding current
        $uniqueSlug = $slug;
        $count = 1;
        while (Blog::where('slug', $uniqueSlug)->where('id', '!=', $blog->id)->exists()) {
            $uniqueSlug = $slug . '-' . $count;
            $count++;
        }

        // Handle Cover Image
        $coverImage = $blog->cover_image;
        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $uploadDir = public_path('images/blogs');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = time() . '_cover_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $coverImage = '/images/blogs/' . $filename;
        } elseif ($request->filled('cover_image')) {
            $coverImage = $request->input('cover_image');
        }

        // Parse FAQs
        $faqs = $this->parseFaqs($request);

        $status = $request->input('status', $blog->status ?? 'publish');
        $isPublished = ($status === 'publish');

        $blog->update([
            'title'            => $title,
            'slug'             => $uniqueSlug,
            'category'         => $validated['category'],
            'short_content'    => $request->input('short_content'),
            'content'          => $request->input('content'),
            'cover_image'      => $coverImage,
            'faqs'             => $faqs,
            'status'           => $status,
            'is_published'     => $isPublished,
            'author'           => $request->input('author', $blog->author ?? 'Hudayriyat Editorial'),
            'meta_title'       => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'meta_keywords'    => $request->input('meta_keywords'),
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog details updated successfully!');
    }

    /**
     * Delete the specified blog post.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }

    /**
     * Toggle status between publish and draft.
     */
    public function updateStatus(Request $request, Blog $blog)
    {
        $status = $request->input('status');
        if (in_array($status, ['publish', 'draft'])) {
            $blog->status = $status;
            $blog->is_published = ($status === 'publish');
            $blog->save();
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'status' => $blog->status]);
        }

        return redirect()->back()->with('success', 'Blog status updated!');
    }

    /**
     * Helper to parse FAQ arrays from form input.
     */
    private function parseFaqs(Request $request): array
    {
        $faqs = [];
        $questions = $request->input('faq_q', []);
        $answers = $request->input('faq_a', []);

        if (is_array($questions) && is_array($answers)) {
            foreach ($questions as $idx => $q) {
                $q = trim($q ?? '');
                $a = trim($answers[$idx] ?? '');
                if ($q !== '' || $a !== '') {
                    $faqs[] = [
                        'question' => $q,
                        'answer'   => $a,
                    ];
                }
            }
        }

        return $faqs;
    }
}
