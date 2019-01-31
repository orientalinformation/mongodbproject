<?php

use Illuminate\Database\Seeder;
use App\Model\AccountManager;

class AccountManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $access = new AccountManager();
        $access->name = 'Access';
        $access->access_documents = 50;
        $access->customizable_curation = 0;
        $access->number_rss = 0;
        $access->customizing_environment = 0;
        $access->number_libraries = 0;
        $access->follow_discussion_groups = 1;
        $access->participation_disussions = json_encode([0, 0 ,0]);
        $access->creating_disussion = json_encode([0, 0 ,0]);
        $access->publicity = 1;
        $access->association_applications = 0;
        $access->save();


        $premium = new AccountManager();
        $premium->name = 'Premium';
        $premium->access_documents = 100;
        $premium->customizable_curation = 1;
        $premium->number_rss = 5;
        $premium->customizing_environment = 5;
        $premium->number_libraries = 10;
        $premium->follow_discussion_groups = 1;
        $premium->participation_disussions = json_encode([1, 1, 0]); 
        $premium->creating_disussion = json_encode([1, 5 ,5]);
        $premium->publicity = 1;
        $premium->association_applications = 0;
        $premium->save();
        
        
        $club = new AccountManager();
        $club->name = 'Club';
        $club->access_documents = 100;
        $club->customizable_curation = 1;
        $club->number_rss = 5;
        $club->customizing_environment = 5;
        $club->number_libraries = 10;
        $club->follow_discussion_groups = 1;
        $club->participation_disussions = json_encode([1, 1, 1]);
        $club->creating_disussion = json_encode([1, 5 ,5]);
        $club->publicity = 0;
        $club->association_applications = 1;
        $club->save();      
    }
}
