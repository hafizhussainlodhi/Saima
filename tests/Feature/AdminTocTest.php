<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\TocItem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTocTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_toc_list(): void
    {
        $user = User::factory()->create();
        $item = TocItem::create([
            'title' => 'Sample TOC Section',
            'target_id' => 'sample-toc-section',
            'order' => 1,
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin/toc');

        $response->assertStatus(200);
        $response->assertSee('TOC Structure');
    }

    public function test_admin_can_open_section_content_editor(): void
    {
        $user = User::factory()->create();
        $item = TocItem::create([
            'title' => 'About the Developers',
            'target_id' => 'about-the-developers',
            'order' => 1,
            'is_active' => true,
            'content' => '<p>Custom Developers Content</p>',
        ]);

        $response = $this->actingAs($user)->get("/admin/toc?edit={$item->id}");

        $response->assertStatus(200);
        $response->assertSee('Edit Section Content');
        $response->assertSee('Custom Developers Content');
    }

    public function test_admin_can_update_section_content(): void
    {
        $user = User::factory()->create();
        $item = TocItem::create([
            'title' => 'About the Developers',
            'target_id' => 'about-the-developers',
            'order' => 1,
            'is_active' => true,
        ]);

        $newHtml = '<p class="saimaP">Updated real-estate text written by admin.</p>';

        $response = $this->actingAs($user)->put("/admin/toc/{$item->id}", [
            'title' => 'About the Developers',
            'target_id' => 'about-the-developers',
            'is_active' => '1',
            'content' => $newHtml,
        ]);

        $response->assertRedirect('/admin/toc');
        $item->refresh();
        $this->assertEquals($newHtml, $item->content);

        // Verify helper renders this custom content
        $rendered = (string) toc_content('about-the-developers', 'fallback');
        $this->assertStringContainsString('Updated real-estate text written by admin.', $rendered);
    }

    public function test_admin_can_drag_and_drop_reorder_toc_items(): void
    {
        $user = User::factory()->create();
        $item1 = TocItem::create(['title' => 'First', 'target_id' => 'first', 'order' => 1]);
        $item2 = TocItem::create(['title' => 'Second', 'target_id' => 'second', 'order' => 2]);
        $item3 = TocItem::create(['title' => 'Third', 'target_id' => 'third', 'order' => 3]);

        // Drag second item to top
        $response = $this->actingAs($user)->postJson('/admin/toc/reorder', [
            'items' => [
                ['id' => $item2->id, 'order' => 1],
                ['id' => $item1->id, 'order' => 2],
                ['id' => $item3->id, 'order' => 3],
            ]
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertEquals(1, $item2->fresh()->order);
        $this->assertEquals(2, $item1->fresh()->order);
        $this->assertEquals(3, $item3->fresh()->order);
    }
}
