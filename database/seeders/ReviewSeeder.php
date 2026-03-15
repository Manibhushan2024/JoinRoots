<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder {
    public function run(): void {
        Review::truncate();
        $reviews = [
            ['name'=>'Rekha Gupta','role'=>'Mother of an 8-year-old','location'=>'South Delhi','rating'=>5,'review_text'=>'My son used to struggle with social anxiety and meltdowns. After 4 months of ASD therapy and parent coaching at Connect Roots, the change is remarkable. The team is incredibly patient and genuinely cares. Dr. Priya is a gem.','avatar_color'=>'#2D6A4F','is_approved'=>true,'display_order'=>1],
            ['name'=>'Amit Verma','role'=>'Father of a 6-year-old','location'=>'Dwarka, Delhi','rating'=>5,'review_text'=>'We joined the online speech therapy sessions as we couldn\'t manage daily travel. Ritika ma\'am is fantastic — my daughter\'s articulation has improved dramatically in just 3 months. Highly recommend!','avatar_color'=>'#7C3AED','is_approved'=>true,'display_order'=>2],
            ['name'=>'Sunita Reddy','role'=>'Mother of a 10-year-old','location'=>'Pitampura, Delhi','rating'=>5,'review_text'=>'Our son was diagnosed with ADHD and we didn\'t know where to turn. The therapy plan was so personalised and the team helped us understand how to support him at home too. School performance has improved noticeably.','avatar_color'=>'#D97706','is_approved'=>true,'display_order'=>3],
            ['name'=>'Pradeep Malhotra','role'=>'Father of a 4-year-old','location'=>'Noida','rating'=>5,'review_text'=>'Early intervention at 3.5 yrs was the best decision. The multi-disciplinary team (OT + speech + paediatrician) worked together seamlessly. Our daughter is now attending mainstream school — something we didn\'t dare dream of!','avatar_color'=>'#DC2626','is_approved'=>true,'display_order'=>4],
            ['name'=>'Kavita Sharma','role'=>'Mother of a 7-year-old','location'=>'Faridabad','rating'=>5,'review_text'=>'The sensory integration therapy has been life-changing for my hyperactive son. Neha ma\'am explains everything so clearly and the sensory gym activities are something my son actually looks forward to!','avatar_color'=>'#0891B2','is_approved'=>true,'display_order'=>5],
            ['name'=>'Rohit Bhatia','role'=>'Parent','location'=>'Gurgaon','rating'=>4,'review_text'=>'Very professional team. The booking system is smooth, invoices are clear, and the therapists are knowledgeable. Would love if they added more centres in Gurgaon too.','avatar_color'=>'#059669','is_approved'=>true,'display_order'=>6],
        ];
        foreach ($reviews as $r) { Review::create($r); }
    }
}
