<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations to clean up all dummy seed data from live database.
     */
    public function up(): void
    {
        // 1. Clean up sample dummy products without real images
        $dummySkus = [
            'SE-MTZ1-08H1',
            'SE-NSX100F-TM80D',
            'SE-ATV630U55N4',
            'SE-LC1D25M7',
            'LEG-001924',
            'GAE-EM-3000',
        ];

        $productIds = DB::table('products')->whereIn('sku', $dummySkus)->pluck('id')->toArray();
        if (!empty($productIds)) {
            DB::table('product_specifications')->whereIn('product_id', $productIds)->delete();
            DB::table('category_product')->whereIn('product_id', $productIds)->delete();
            DB::table('products')->whereIn('id', $productIds)->delete();
        }

        // 2. Clean up sample dummy projects without images
        $dummyProjectCodes = ['PRJ-SUB-2500A', 'PRJ-COLD-01'];
        $dummyProjectSlugs = [
            '2500a-low-voltage-main-distribution-panel-substation',
            'cold-storage-precision-temperature-motor-control-center',
        ];

        DB::table('projects')
            ->whereIn('project_code', $dummyProjectCodes)
            ->orWhereIn('slug', $dummyProjectSlugs)
            ->delete();

        // 3. Fix dummy WhatsApp number in site_settings (081234567890 -> 082223332830)
        DB::table('site_settings')
            ->where('key', 'whatsapp')
            ->where(function ($q) {
                $q->where('value', '081234567890')
                  ->orWhere('value', '6281234567890')
                  ->orWhere('value', '+6281234567890');
            })
            ->update(['value' => '082223332830', 'updated_at' => now()]);

        $waExists = DB::table('site_settings')->where('key', 'whatsapp')->first();
        if ($waExists && in_array(trim($waExists->value ?? ''), ['', '081234567890', '6281234567890'])) {
            DB::table('site_settings')->where('key', 'whatsapp')->update(['value' => '082223332830', 'updated_at' => now()]);
        }

        // 4. Remove fake demo Google Drive links on About Us
        DB::table('site_settings')
            ->whereIn('key', ['company_profile_drive_url', 'panel_project_doc_drive_url'])
            ->where('value', 'like', '%_demo%')
            ->update(['value' => null, 'updated_at' => now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse needed for dummy data cleanup
    }
};
