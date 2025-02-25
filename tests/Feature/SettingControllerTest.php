<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SettingControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'user_type' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->actingAs($this->user);
    }

    /**
     * @test
     * load page correctly
     */
    public function test_user_profile_setting_page_loads_correctly()
    {
        $response = $this->get(route('user-profile-setting'));
        $response->assertStatus(200)
            ->assertViewIs('pages.user-profile-setting');
    }

    /**
     * @test
     * load page correctly
     */
    public function test_setting_page_loads_correctly()
    {
        $response = $this->get(route('setting'));
        $response->assertStatus(200)
            ->assertViewIs('pages.setting');
    }

    public function test_update_profile_with_profile_image()
    {
        Storage::fake('public');

        $updateData = [
            'business_email' => 'new@business.com',
            'business_name' => 'New Business Name',
            'address' => '123 Business St',
            'postal_code' => '12345',
            'country' => 'United States',
            'business_phone' => '1234567890',
            'profileImg' => UploadedFile::fake()->image('profile.jpg'),
        ];

        $response = $this->post(route('profile-update'), $updateData);

        $response->assertRedirect(route('user-profile-setting'))
            ->assertSessionHas('success', 'Profile updated successfully.');

        $this->user->refresh();

        $this->assertEquals('new@business.com', $this->user->business_email);
        $this->assertEquals('New Business Name', $this->user->business_name);
        $this->assertNotNull($this->user->picture);
        $this->assertFileExists(public_path('images/'.$this->user->picture));
    }

    public function test_update_profile_with_logo()
    {
        Storage::fake('public');

        $updateData = [
            'business_name' => 'Logo Test Business',
            'logo' => UploadedFile::fake()->image('logo.jpg'),
        ];

        $response = $this->post(route('profile-update'), $updateData);

        $response->assertRedirect(route('user-profile-setting'))
            ->assertSessionHas('success', 'Profile updated successfully.');

        $this->user->refresh();

        $this->assertEquals('Logo Test Business', $this->user->business_name);
        $this->assertNotNull($this->user->logo);
        $this->assertFileExists(public_path('images/'.$this->user->logo));
    }

    public function test_update_profile_with_new_password()
    {
        $updateData = [
            'business_name' => 'Password Test Business',
            'password' => 'newpassword123',
            'conPassword' => 'newpassword123',

        ];

        $response = $this->post(route('profile-update'), $updateData);

        $response->assertRedirect(route('user-profile-setting'))
            ->assertSessionHas('success', 'Profile updated successfully.');

        $this->user->refresh();

        $this->assertEquals('Password Test Business', $this->user->business_name);
        $this->assertTrue(Hash::check($updateData['password'], $this->user->password));
    }

    public function test_update_invoice_settings()
    {
        $updateData = [
            'current_template' => 'custom-template',
            'per_page' => 20,
            'custom_note' => 'Custom Note',
            'custom_note_heading' => 'Important:',
        ];

        $response = $this->post(route('profile-update'), $updateData);

        $response->assertRedirect(route('user-profile-setting'))
            ->assertSessionHas('success', 'Profile updated successfully.');

        $this->user->refresh();

        $this->assertEquals('custom-template', $this->user->invoice_template);
        $this->assertEquals(20, $this->user->per_page);
        // Pending
        // $this->assertEquals('Custom Note', $this->user->custom_note);
        // $this->assertEquals('Important:', $this->user->custom_note_heading);
    }

    public function test_unauthorized_access_redirects_to_login()
    {
        auth()->logout();

        $response = $this->get(route('user-profile-setting'));

        $response->assertRedirect('/login');
    }

    public function test_unverified_email_redirects_to_verification()
    {
        $unverifiedUser = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $this->actingAs($unverifiedUser);

        $response = $this->get(route('user-profile-setting'));

        $response->assertRedirect('/email/verify');
    }

    public function test_delete_old_profile_image_when_updating()
    {
        // First upload an initial profile image
        $this->post(route('profile-update'), [
            'profileImg' => UploadedFile::fake()->image('old-profile.jpg'),
        ]);

        $this->user->refresh();
        $oldImagePath = $this->user->picture;

        // Upload a new profile image
        $this->post(route('profile-update'), [
            'profileImg' => UploadedFile::fake()->image('new-profile.jpg'),
        ]);

        $this->assertFileDoesNotExist(public_path('images/'.$oldImagePath));
    }

    public function test_delete_old_logo_when_updating()
    {
        // First upload an initial logo
        $this->post(route('profile-update'), [
            'logo' => UploadedFile::fake()->image('old-logo.jpg'),
        ]);

        $this->user->refresh();
        $oldLogoPath = $this->user->logo;

        // Upload a new logo
        $this->post(route('profile-update'), [
            'logo' => UploadedFile::fake()->image('new-logo.jpg'),
        ]);

        $this->assertFileDoesNotExist(public_path('images/'.$oldLogoPath));
    }

    public function test_default_values_when_optional_fields_not_provided()
    {
        $response = $this->post(route('profile-update'), [
            'business_name' => 'Test Business',
        ]);

        $this->user->refresh();
        $this->assertEquals('Test Business', $this->user->business_name);
        $this->assertEquals('Pakistan', $this->user->country);
        $this->assertEquals(10, $this->user->per_page);
        // Pending

        // $this->assertEquals('NOTICE:', $this->user->custom_note_heading);
        // $this->assertEquals(
        //     'A finance charge of 1.5% will be made on unpaid balances after 30 days.',
        //     $this->user->custom_note
        // );
    }
}
