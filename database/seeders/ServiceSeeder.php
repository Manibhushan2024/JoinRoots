<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder {
    public function run(): void {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Service::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $services = [
            ['title'=>'Speech Therapy','description'=>'Comprehensive speech-language therapy for children with articulation disorders, speech delays, stuttering, cluttering, and voice disorders. Our certified SLPs use play-based methods tailored to each child.','offline_price'=>1200,'online_price'=>900,'category'=>'Speech & Language','icon'=>'fas fa-microphone-alt','color'=>'#2D6A4F'],
            ['title'=>'Applied Behaviour Analysis (ABA)','description'=>'Evidence-based ABA therapy for children with Autism Spectrum Disorder. Our BCBAs design intensive, personalised programs to improve communication, social skills, and daily living.','offline_price'=>1500,'online_price'=>1200,'category'=>'Behavioural','icon'=>'fas fa-brain','color'=>'#7C3AED'],
            ['title'=>'Occupational Therapy (OT)','description'=>'OT helps children develop fine motor skills, sensory processing, self-care routines, and school readiness. Ideal for children with developmental delays or co-ordination difficulties.','offline_price'=>1200,'online_price'=>950,'category'=>'Motor Skills','icon'=>'fas fa-hands','color'=>'#0891B2'],
            ['title'=>'Behavioural Therapy','description'=>'Structured CBT and behavioural intervention for children with ADHD, ODD, anxiety, and conduct disorders. We use positive reinforcement strategies that parents can continue at home.','offline_price'=>1000,'online_price'=>800,'category'=>'Behavioural','icon'=>'fas fa-child','color'=>'#D97706'],
            ['title'=>'Sensory Integration Therapy','description'=>'Designed for children with Sensory Processing Disorder (SPD). Sessions involve structured movement and touch activities to help the nervous system process sensory information correctly.','offline_price'=>1100,'online_price'=>900,'category'=>'Sensory','icon'=>'fas fa-spa','color'=>'#059669'],
            ['title'=>'Autism Spectrum Disorder (ASD) Therapy','description'=>'Multi-disciplinary intervention combining ABA, speech therapy, OT, and social skills training for children on the autism spectrum. We partner closely with families for generalisation.','offline_price'=>1500,'online_price'=>1200,'category'=>'Autism','icon'=>'fas fa-puzzle-piece','color'=>'#DC2626'],
            ['title'=>'ADHD Evaluation & Therapy','description'=>'Comprehensive assessment and personalised management plans for children with Attention Deficit Hyperactivity Disorder. Includes parent coaching and school co-ordination.','offline_price'=>1000,'online_price'=>800,'category'=>'ADHD','icon'=>'fas fa-bolt','color'=>'#F59E0B'],
            ['title'=>'Dyslexia & Learning Disability Support','description'=>'Specialised support for children with Dyslexia, Dyscalculia, and other learning differences. Our remedial educators design IEPs to unlock every child\'s academic potential.','offline_price'=>1000,'online_price'=>800,'category'=>'Learning','icon'=>'fas fa-book-open','color'=>'#2563EB'],
            ['title'=>'Special Education (SPED)','description'=>'One-on-one special education sessions adapted to IEP goals. Focuses on literacy, numeracy, life skills, and school inclusion for children with intellectual or developmental disabilities.','offline_price'=>900,'online_price'=>750,'category'=>'Education','icon'=>'fas fa-graduation-cap','color'=>'#7C3AED'],
            ['title'=>'Child Psychology & Counselling','description'=>'Play therapy and psychological counselling for children dealing with anxiety, depression, grief, trauma, or family transitions. Safe, confidential sessions led by clinical psychologists.','offline_price'=>1200,'online_price'=>1000,'category'=>'Psychology','icon'=>'fas fa-heart','color'=>'#DB2777'],
            ['title'=>'Early Intervention (0-6 Years)','description'=>'Critical first-years intervention for infants and toddlers showing developmental delays. Multi-disciplinary approach involving physiotherapy, OT, speech, and parent guidance.','offline_price'=>1000,'online_price'=>800,'category'=>'Early Intervention','icon'=>'fas fa-baby','color'=>'#0891B2'],
            ['title'=>'Physiotherapy for Children','description'=>'Paediatric physio for children with cerebral palsy, Down Syndrome, muscular dystrophy, orthopaedic conditions, and post-surgery rehabilitation. Improves mobility and strength.','offline_price'=>1200,'online_price'=>950,'category'=>'Physio','icon'=>'fas fa-running','color'=>'#16A34A'],
            ['title'=>'Parent Training & Coaching','description'=>'Structured workshops and 1:1 coaching to equip parents with evidence-based strategies to support their child\'s development, manage behaviours, and reinforce therapy at home.','offline_price'=>800,'online_price'=>600,'category'=>'Parent Support','icon'=>'fas fa-users','color'=>'#D97706'],
            ['title'=>'Developmental Paediatric Consultation','description'=>'Diagnostic consultation with our developmental paediatrician. Includes thorough assessment, developmental screening, and referral to the right therapy pathway.','offline_price'=>1500,'online_price'=>1200,'category'=>'Consultation','icon'=>'fas fa-user-md','color'=>'#2D6A4F'],
        ];
        foreach ($services as $s) {
            Service::create(array_merge($s, [
                'price_range' => '₹'.number_format($s['online_price']).' – ₹'.number_format($s['offline_price']),
                'rating' => rand(45,50)/10,
                'image_url' => null,
            ]));
        }
    }
}
