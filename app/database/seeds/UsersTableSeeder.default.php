<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
    	DB::table('users')->delete();
		
		$now = date('Y-m-d H:i:s');
        
        $i = 0;
        $users[$i] = array();
        $users[$i]['username']       = 'johndoe';
        $users[$i]['name']           = 'John Doe';
        $users[$i]['role']           = 'admin';
        $users[$i]['bio']            = 'No information yet';

        $users[$i]['publichash']     = 'hash-'.$users[$i]['username'].'-hash';
        $users[$i]['password']       = Hash::make($users[$i]['username']);
        $users[$i]['email']          = 'insert-real-email-here';
        $users[$i]['activated']      = 1;
        $users[$i]['created_at']     = $now;
        $users[$i]['updated_at']     = $now;

        // $i++;
        // $users[$i] = array();
        // $users[$i]['username']       = 'janedoe';
        // $users[$i]['name']           = 'Jane Doe';
        // $users[$i]['role']           = 'contributor';
        // $users[$i]['bio']            = 'No information yet';

        // $users[$i]['publichash']     = 'hash-'.$users[$i]['username'].'-hash';
        // $users[$i]['password']       = Hash::make($users[$i]['username']);
        // $users[$i]['email']          = 'insert-real-email-here';
        // $users[$i]['activated']      = 1;
        // $users[$i]['created_at']     = $now;
        // $users[$i]['updated_at']     = $now;

        foreach($users as $user){
            DB::table('users')->insert($user);
        }

    }

}