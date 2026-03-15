<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class DoctorSeeder extends Seeder {
    public function run(): void {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Doctor::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $doctors = [
            ['name'=>'Dr. Priya Sharma','designation'=>'Child Psychologist & Lead Therapist','qualification'=>'Ph.D. Clinical Psychology, NIMHANS Bangalore','bio'=>'Dr. Priya has 12 years of experience working with children with autism, ADHD, and anxiety disorders. She specialises in play therapy, CBT, and family-based interventions.','specializations'=>'ASD Therapy, ADHD, Child Counselling, CBT','experience_years'=>12,'display_order'=>1],
            ['name'=>'Dr. Anil Kumar','designation'=>'Developmental Paediatrician','qualification'=>'MD Paediatrics, AIIMS Delhi | Fellowship in Developmental Paediatrics','bio'=>'Dr. Anil leads our diagnostic and early intervention team. With over 18 years at AIIMS and private practice, he provides detailed developmental assessments and treatment roadmaps.','specializations'=>'Early Intervention, ASD Diagnosis, ADHD, Developmental Screening','experience_years'=>18,'display_order'=>2],
            ['name'=>'Ms. Ritika Verma','designation'=>'Senior Speech-Language Pathologist','qualification'=>'M.Sc. SLP, RCI Certified, AIISH Mysore','bio'=>'Ritika is an RCI-certified SLP with 9 years of experience treating speech delays, stuttering, expressive language disorders, and feeding difficulties in children from 18 months to 16 years.','specializations'=>'Speech Therapy, Language Disorders, Stuttering, Feeding Therapy','experience_years'=>9,'display_order'=>3],
            ['name'=>'Ms. Neha Gupta','designation'=>'Occupational Therapist & Sensory Integration Specialist','qualification'=>'B.OTh, SIPT Certified, Sensory Integration International','bio'=>'Neha specialises in sensory processing disorders and fine motor development. She runs our sensory gym at the clinic and consults via video for home-based OT programs.','specializations'=>'Occupational Therapy, Sensory Integration, Fine Motor, SPD','experience_years'=>7,'display_order'=>4],
            ['name'=>'Mr. Ravi Prakash','designation'=>'Board Certified Behaviour Analyst (BCBA)','qualification'=>'M.A. Applied Behaviour Analysis, BCBA Certified (USA)','bio'=>'Ravi leads our ABA team. He has conducted over 10,000 hours of direct ABA therapy and trains parents and school teachers in behaviour management strategies.','specializations'=>'ABA Therapy, Autism, Behaviour Management, Parent Training','experience_years'=>10,'display_order'=>5],
        ];
        foreach ($doctors as $d) { Doctor::create($d); }
    }
}
