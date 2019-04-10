<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(\Faker\Generator::class);
        // 头像假数据
        $avatars = [
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];
        // 生成数据集合
        $user = factory(\App\Models\User::class)->times(10)->make()->each(
            function ($user,$index) use ($faker,$avatars){
                // 从头像数组中随机取出一个并赋值
                $user->avatar = $faker->randomElement($avatars);
            }
        );
        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $user->makeVisible(['password', 'remember_token'])->toArray();
        \App\Models\User::insert($user_array);
        $user = \App\Models\User::find(1);
        $user->name = "index";
        $user->email = "1024659300@qq.com";
        $user->password = bcrypt("admin888");
        $user->avatar = 'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        $user->save();
    }
}
