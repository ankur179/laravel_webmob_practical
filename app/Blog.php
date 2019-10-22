<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Categories;

class Blog extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'content'
    ];
    public function categories(){
        return $this->belongsToMany(Categories::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
//     public function blogList()
//        {
//            $user_id = Auth::user()->id;
//            $data['data'] = DB::table('users')
//                ->join('publications', 'users.id', '=', 'publications.user_id')
//                ->join('education', 'users.id', '=', 'education.user_id')
//                ->select('users.id','publications.*','education.research_area')
//                ->where('users.id',$user_id) // else it will get all rows
//                ->get();
//            if(count ($data)>0){
//                return view('pdf/publicationpdf',$data)->with($user_id);
//            }
//            else
//            {
//                return view('pdf/publicationpdf');
//            }
//        }
}
