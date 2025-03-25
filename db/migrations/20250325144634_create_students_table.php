<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class createstudentstable extends AbstractMigration
{
    public function change(): void
    {
        // Insert students data into the student table
        $this->table('student')
            ->insert([
                [
                    'studentid' => '20000001',
                    'password' => 'a1b2c3d4',
                    'dob' => '1999-05-15',
                    'firstname' => 'Alice',
                    'lastname' => 'Johnson',
                    'house' => '10 Maple Street',
                    'town' => 'Oxford',
                    'county' => 'Oxfordshire',
                    'country' => 'UK',
                    'postcode' => 'OX1 2AT',
                ],
                [
                    'studentid' => '20000002',
                    'password' => 'berkshire123',
                    'dob' => '2000-08-20',
                    'firstname' => 'Bob',
                    'lastname' => 'Williams',
                    'house' => '22 Oak Drive',
                    'town' => 'Reading',
                    'county' => 'Berkshire',
                    'country' => 'UK',
                    'postcode' => 'RG1 3ES',
                ],
                [
                    'studentid' => '20000003',
                    'password' => 'bristol456',
                    'dob' => '1998-03-25',
                    'firstname' => 'Charlie',
                    'lastname' => 'Brown',
                    'house' => '33 Pine Avenue',
                    'town' => 'Bristol',
                    'county' => 'Avon',
                    'country' => 'UK',
                    'postcode' => 'BS1 4PA',
                ],
                [
                    'studentid' => '20000004',
                    'password' => 'london123',
                    'dob' => '1997-11-11',
                    'firstname' => 'David',
                    'lastname' => 'Taylor',
                    'house' => '44 Elm Street',
                    'town' => 'London',
                    'county' => 'Greater London',
                    'country' => 'UK',
                    'postcode' => 'E1 5AA',
                ],
                [
                    'studentid' => '20000005',
                    'password' => 'cambridge001',
                    'dob' => '1996-12-04',
                    'firstname' => 'Emma',
                    'lastname' => 'Davis',
                    'house' => '55 Birch Road',
                    'town' => 'Cambridge',
                    'county' => 'Cambridgeshire',
                    'country' => 'UK',
                    'postcode' => 'CB2 3DL',
                ]
            ])
            ->save();

        // Insert student-module associations into studentmodules table
        $this->table('studentmodules')
            ->insert([
                ['studentid' => '20000001', 'modulecode' => 'CO106'],
                ['studentid' => '20000001', 'modulecode' => 'IN251'],
                ['studentid' => '20000002', 'modulecode' => 'CO107'],
                ['studentid' => '20000002', 'modulecode' => 'IN251'],
                ['studentid' => '20000003', 'modulecode' => 'CO106'],
                ['studentid' => '20000003', 'modulecode' => 'CO107'],
                ['studentid' => '20000004', 'modulecode' => 'IN251'],
                ['studentid' => '20000004', 'modulecode' => 'CO106'],
                ['studentid' => '20000005', 'modulecode' => 'CO107'],
                ['studentid' => '20000005', 'modulecode' => 'IN251']
            ])
            ->save();
    }
}
