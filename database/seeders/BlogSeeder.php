<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use Carbon\Carbon;

class BlogSeeder extends Seeder {
    public function run(): void {
        BlogPost::truncate();
        $posts = [
            [
                'title'=>'Early Signs of Autism in Children: What Parents Should Watch For',
                'slug'=>'early-signs-of-autism-in-children',
                'excerpt'=>'Early detection of Autism Spectrum Disorder can dramatically improve outcomes. Learn the key developmental milestones and red flags to watch for in your child\'s first three years.',
                'content'=>'<p>Autism Spectrum Disorder (ASD) affects 1 in every 68 children in India. Early identification — ideally before age 3 — is critical because the brain is most plastic during this period and intensive therapy delivers the best results.</p><h3>Key Red Flags by Age</h3><ul><li><strong>By 12 months:</strong> No babbling, no gesturing (e.g. pointing, waving), no response to own name.</li><li><strong>By 16 months:</strong> No single words spoken.</li><li><strong>By 24 months:</strong> No two-word spontaneous phrases (not just echoing).</li><li><strong>Any age:</strong> Loss of previously acquired language or social skills.</li></ul><h3>Social Communication Signs</h3><p>Children with ASD often show limited eye contact, reduced sharing of enjoyment (e.g. rarely pointing to show you something interesting), and difficulty with back-and-forth conversation. They may prefer solitary play and show little interest in other children.</p><h3>What to Do</h3><p>If you notice any of these signs, do not wait. Contact a developmental paediatrician for a formal assessment. At Connect Roots, our team offers comprehensive multi-disciplinary ASD evaluations in Delhi.</p>',
                'author'=>'Dr. Anil Kumar','category'=>'Autism','is_published'=>true,'published_at'=>Carbon::now()->subDays(5),
            ],
            [
                'title'=>'Speech Therapy at Home: 10 Activities to Practice Between Sessions',
                'slug'=>'speech-therapy-activities-at-home',
                'excerpt'=>'Therapy sessions are essential, but what happens at home matters just as much. Here are 10 fun, evidence-based activities your child will enjoy that reinforce speech therapy goals.',
                'content'=>'<p>Speech therapy works best when practice continues beyond the clinic. Here are 10 structured activities recommended by our SLPs at Connect Roots Delhi.</p><ol><li><strong>Mirror Talk:</strong> Sit with your child in front of a mirror. Take turns making sounds and shapes with your mouths. This builds oral motor awareness.</li><li><strong>Storybook Reading:</strong> Choose books with repetitive lines (e.g. "Brown Bear, Brown Bear"). Pause and encourage your child to fill in the next word.</li><li><strong>Blowing Games:</strong> Bubbles, whistles, and cotton balls help strengthen the breath support needed for clear speech.</li><li><strong>Category Sorting:</strong> Group objects by category (animals, foods, vehicles) to build vocabulary and language comprehension.</li><li><strong>I-Spy:</strong> Classic and effective for descriptive language — "I spy something round and red..." </li><li><strong>Singing Songs:</strong> Nursery rhymes build phonological awareness, a key pre-reading skill.</li><li><strong>Barrier Games:</strong> Sit back to back and describe an object for your child to draw without seeing it. Excellent for precise language use.</li><li><strong>Feelings Check-in:</strong> Use an emotion chart daily to build vocabulary around feelings.</li><li><strong>Snack Time Talk:</strong> Use meal times to practise requesting ("I want..."), describing, and labelling.</li><li><strong>Video Calls with Family:</strong> Real conversational practice with grandparents motivates children naturally.</li></ol><p>Remember: 10-15 minutes of consistent practice daily is more effective than one long weekly session outside therapy.</p>',
                'author'=>'Ms. Ritika Verma','category'=>'Speech Therapy','is_published'=>true,'published_at'=>Carbon::now()->subDays(12),
            ],
            [
                'title'=>'Understanding ADHD in Children: Myths, Facts, and What Really Helps',
                'slug'=>'understanding-adhd-in-children-myths-and-facts',
                'excerpt'=>'ADHD is one of the most misunderstood conditions in children. We bust common myths and share what evidence-based management actually looks like for Indian families.',
                'content'=>'<p>Attention Deficit Hyperactivity Disorder (ADHD) affects approximately 5-8% of school-age children. Despite its prevalence, it remains deeply misunderstood — especially in India.</p><h3>Common Myths</h3><ul><li><strong>Myth: "My child just needs more discipline."</strong> ADHD is a neurodevelopmental condition. More punishment does not help — it often makes things worse by damaging self-esteem.</li><li><strong>Myth: "Only hyperactive boys have ADHD."</strong> ADHD presents in three subtypes: predominantly inattentive, predominantly hyperactive, and combined. Girls often present with the inattentive type and go undiagnosed for years.</li><li><strong>Myth: "Medication is the only solution."</strong> Behavioural therapy and parent training are first-line treatments for children under 6. For older children, a combination of therapy and medication (when needed) is most effective.</li></ul><h3>What Actually Helps</h3><p>A multimodal approach works best: <strong>Behavioural therapy</strong> to teach self-regulation skills, <strong>parent training</strong> to create structured home routines, <strong>school liaison</strong> to implement accommodations, and where clinically indicated, <strong>medication</strong> supervised by a psychiatrist or paediatrician.</p><p>At Connect Roots, our ADHD team includes a developmental paediatrician, behaviour therapist, and special educator who work together on a unified plan for your child.</p>',
                'author'=>'Dr. Priya Sharma','category'=>'ADHD','is_published'=>true,'published_at'=>Carbon::now()->subDays(20),
            ],
        ];
        foreach ($posts as $p) { BlogPost::create($p); }
    }
}
