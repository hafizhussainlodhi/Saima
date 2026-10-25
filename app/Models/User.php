<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'permissions',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'permissions' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public const PERMISSIONS = [
        'pages'   => 'Pages & Dynamic Blocks',
        'toc'     => 'Table of Contents',
        'seo'     => 'Global SEO & Indexing',
        'footer'  => 'Footer & Newsletter',
        'leads'   => 'Sales Leads & Inquiries',
        'users'   => 'Users & Permissions',
    ];

    public const MODULES = [
        'pages' => [
            'name' => 'Pages & Dynamic Blocks',
            'desc' => 'Manage pages, page blocks, SEO titles, and layout builders',
            'actions' => [
                'view'   => 'View / View Any',
                'create' => 'Create',
                'edit'   => 'Edit / Update',
                'delete' => 'Delete',
            ],
        ],
        'toc' => [
            'name' => 'Table of Contents',
            'desc' => 'Manage community TOC items, sections, ordering, and content',
            'actions' => [
                'view'   => 'View / View Any',
                'create' => 'Create',
                'edit'   => 'Edit / Update',
                'delete' => 'Delete',
            ],
        ],
        'seo' => [
            'name' => 'Global SEO & Indexing',
            'desc' => 'Configure search engine indexing on/off, meta tags, and analytics',
            'actions' => [
                'view'   => 'View / View Any',
                'create' => 'Create',
                'edit'   => 'Edit / Update',
                'delete' => 'Delete',
            ],
        ],
        'footer' => [
            'name' => 'Footer & Newsletter',
            'desc' => 'Manage brand text, social links, footer columns drag & drop, and bottom bar',
            'actions' => [
                'view'   => 'View / View Any',
                'create' => 'Create',
                'edit'   => 'Edit / Update',
                'delete' => 'Delete',
            ],
        ],
        'leads' => [
            'name' => 'Sales Leads & Inquiries',
            'desc' => 'View customer inquiries, export leads CSV, and update lead status',
            'actions' => [
                'view'   => 'View / View Any',
                'create' => 'Create',
                'edit'   => 'Edit / Update',
                'delete' => 'Delete',
            ],
        ],
        'users' => [
            'name' => 'Users & Permissions',
            'desc' => 'Manage admin staff accounts and assign granular security roles',
            'actions' => [
                'view'   => 'View / View Any',
                'create' => 'Create',
                'edit'   => 'Edit / Update',
                'delete' => 'Delete',
            ],
        ],
    ];

    public function isSuperAdmin(): bool
    {
        if (empty($this->role) || $this->role === 'super_admin') {
            return true;
        }

        return $this->role === 'admin' && (empty($this->permissions) || in_array('*', $this->permissions ?? []));
    }

    public function hasPermission(string $permission, ?string $action = null): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        $perms = $this->permissions ?? [];
        if (in_array('*', $perms)) {
            return true;
        }

        if (str_contains($permission, '.')) {
            [$module, $act] = explode('.', $permission, 2);
        } else {
            $module = $permission;
            $act = $action;
        }

        // Direct whole-module match (e.g. ['pages'])
        if (in_array($module, $perms) || in_array("{$module}.*", $perms)) {
            return true;
        }

        // If checking general access to module (e.g. for sidebar or index)
        if ($act === null || $act === 'view') {
            if (in_array("{$module}.view", $perms)) {
                return true;
            }
            // If user has any action assigned in this module, allow viewing
            foreach ($perms as $p) {
                if (str_starts_with($p, "{$module}.")) {
                    return true;
                }
            }
            return false;
        }

        return in_array("{$module}.{$act}", $perms);
    }
}
