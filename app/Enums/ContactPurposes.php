<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

// 1.⁠ ⁠Informasi Produk = Product Inquiry
// (Termasuk didalamnya nanya lokasi pembelian, nanya Harga, nanya katalog, nanya terkait produk tertentu)
// 2.⁠ ⁠Komplain Produk = Product Complaint
// (Semua komplain seputar produk)
// 3. Informasi Kemitraan = Business Partnership Inquiry
// (Semua info dan pertanyaan utk resellership, kemitraan agen, atau jadi distributor)
// 4.⁠ ⁠Proposal Event/Sponsorship = Event Proposal/Sponsorship
// (Semua info seputar kerja sama / sponsorship dari sekolah, kampus atau brand lain)
// 5.⁠ ⁠Penawaran Supplier/Vendor = Supplier/Vendor Proposal
// (Semua penawaran utk kerja sama supplier dan vendor)
// 6.⁠ ⁠Karir = Career
// (Semua pertanyaan tentang loker)
// 7.⁠ ⁠Lainnya = Others
// (ini mungkin diluar dari 6 poin di atas)

enum ContactPurposes: string implements HasLabel
{
    case PRODUCT_INQUIRY = 'product_inquiry';
    case PRODUCT_COMPLAINT = 'product_complaint';
    case BUSINESS_PARTNERSHIP_INQUIRY = 'business_partnership_inquiry';
    case EVENT_PROPOSAL_SPONSORSHIP = 'event_proposal_sponsorship';
    case SUPPLIER_VENDOR_PROPOSAL = 'supplier_vendor_proposal';
    case CAREER = 'career';
    case OTHERS = 'others';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PRODUCT_INQUIRY => __('contact.form.purpose.product_inquiry'),
            self::PRODUCT_COMPLAINT => __('contact.form.purpose.product_complaint'),
            self::BUSINESS_PARTNERSHIP_INQUIRY => __('contact.form.purpose.business_partnership_inquiry'),
            self::EVENT_PROPOSAL_SPONSORSHIP => __('contact.form.purpose.event_proposal_sponsorship'),
            self::SUPPLIER_VENDOR_PROPOSAL => __('contact.form.purpose.supplier_vendor_proposal'),
            self::CAREER => __('contact.form.purpose.career'),
            self::OTHERS => __('contact.form.purpose.others'),
        };
    }
}
