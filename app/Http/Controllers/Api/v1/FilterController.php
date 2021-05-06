<?php

    namespace App\Http\Controllers\Api\v1;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\FilterDataRequests\GetFilterDataRequest;
    use App\Models\Gender;
    use App\Models\Photo;
    use App\Models\Video;
    use App\Models\ViewBio;
    use Database\Seeders\ViewsSeeder;
    use Illuminate\Http\Request;

    class FilterController extends Controller
    {

        public function getFilteredData(GetFilterDataRequest $request)
        {

            /*$seeder = new ViewsSeeder();
            $seeder->run();*/

            $filter_data = $request->all();
            $filter = array_key_exists('params', $filter_data) ? $filter_data['params'] : $filter_data;

            $query = new ViewBio();
            $process = 0;
            $perpage = 5;

            if (isset($filter['id'])) {
                $id = $filter['id'];
                $query = $query->where('vbios.user_id', '=', $id);
                $process = 1;
            }

            if ($process == 0) {

                if (isset($filter['perpage'])) {
                    $perpage = (int)$filter['perpage'];
                }

                if (isset($filter['gender'])) {
                    $gender = $filter['gender'];

                    if (in_array($gender, ['male', 'female'])) {
                        $query = $query->where('vbios.gender', '=', $gender);
                    }
                }

                if (isset($filter['last_name'])) {
                    $term = $filter['last_name'];
                    $query = $query->where('vbios.last_name', 'LIKE', '%' . $term . '%');
                }

                if (isset($filter['first_name'])) {
                    $term = $filter['first_name'];
                    $query = $query->where('vbios.first_name', 'LIKE', '%' . $term . '%');
                }

                if (isset($filter['age']) && isset($filter['birthday'])) {
                    $t = strtotime($filter['birthday']);
                    $term = date('Y-m', $t);
                    $query = $query->where('vbios.birthday', 'LIKE', '%' . $term . '%');

                } elseif (isset($filter['birthday'])) {

                    $t = strtotime($filter['birthday']);
                    $term = date('Y', $t);
                    $query = $query->where('vbios.birthday', 'LIKE', '%' . $term . '%');

                } elseif (isset($filter['age'])) {
                    $term = $filter['age'];
                    $query = $query->where('vbios.age', '=', $term);
                }

            }

            $query = $query->select(
                'vbios.last_name', 'vbios.first_name', 'vbios.age', 'vbios.birthday', 'vbios.short_bio',
                'vbios.gender', 'vbios.user_id', 'vbios.bio'
            )
                //->get();
                ->paginate(5);

            $pagination_full = $query->toArray();

            $pagination = [
                'current_page' => $pagination_full['current_page'],
                'total' => $pagination_full['total'],
                'from' => $pagination_full['last_page'],
                'to' => $pagination_full['to'],
                'prev_page_url' => $pagination_full['prev_page_url'],
                'next_page_url' => $pagination_full['next_page_url'],
                'path' => $pagination_full['path'],
                'per_page' => $pagination_full['per_page'],
                'last_page' => $pagination_full['last_page'],
                'first_page_url' => $pagination_full['first_page_url'],
                'last_page_url' => $pagination_full['last_page_url'],
            ];

            $query = $query->map(function ($item) {
                return [
                    'user_id' => $item->user_id,
                    'gender' => $item->gender,
                    'last_name' => $item->last_name,
                    'first_name' => $item->first_name,
                    'birthday' => $item->birthday,
                    'age' => $item->age,
                    'photos' => Photo::getPhotoByUser($item->user_id),
                    'videos' => Video::getVideoByUser($item->user_id),
                    'short_bio' => $item->short_bio,
                    'bio' => $item->bio,
                ];
            });

            $message = [
                'pagination' => $pagination,
                'success' => true,
                'message' => 'successful',
                'data' => $query,
            ];

            return $message;

        }

        public function getFilteredDataAvatars(GetFilterDataRequest $request)
        {

            /*$seeder = new ViewsSeeder();
            $seeder->run();*/

            $filter_data = $request->all();
            $filter = array_key_exists('params', $filter_data) ? $filter_data['params'] : $filter_data;

            $query = new ViewBio();

            $perpage = 15;
            $multiplicity = 3;
            $process = 0;

            if (isset($filter['id'])) {
                $id = $filter['id'];
                $query = $query->where('vbios.user_id', '=', $id);
                $process = 1;
            }

            if ($process == 0) {

                if (isset($filter['perpage'])) {
                    $perpage = (int)$filter['perpage'];

                    if ($perpage % $multiplicity != 0) {
                        $perpage_m = intdiv($perpage, $multiplicity);
                        $perpage = $perpage_m * $multiplicity;
                    }

                    if ($perpage > 32) {
                        $perpage = 16;
                    }

                    if ($perpage < 8) {
                        $perpage = 8;
                    }
                }


                if (isset($filter['gender'])) {
                    $gender = $filter['gender'];

                    if (in_array($gender, ['male', 'female'])) {
                        $query = $query->where('vbios.gender', '=', $gender);
                    }
                }

                if (isset($filter['name_search'])) {
                    $term = $filter['name_search'];
                    $query = $query->where('vbios.first_name', 'LIKE', '%' . $term . '%');
                    $query = $query->orWhere('vbios.last_name', 'LIKE', '%' . $term . '%');
                }

                if (isset($filter['last_name'])) {
                    $term = $filter['last_name'];
                    $query = $query->where('vbios.last_name', 'LIKE', '%' . $term . '%');
                }

                if (isset($filter['first_name'])) {
                    $term = $filter['first_name'];
                    $query = $query->where('vbios.first_name', 'LIKE', '%' . $term . '%');
                }

                if (isset($filter['birthday'])) {

                    $t = strtotime($filter['birthday']);
                    $term = date('Y', $t);
                    $query = $query->where('vbios.birthday', 'LIKE', '%' . $term . '%');

                }

                if (isset($filter['age'])) {
                    $term = (int)$filter['age'];
                    $query = $query->where('vbios.age', '=', $term);
                }

            }

            $query = $query->select(
                'vbios.last_name', 'vbios.first_name', 'vbios.age', 'vbios.birthday', 'vbios.short_bio',
                'vbios.gender', 'vbios.user_id', 'vbios.bio'
            )
                ->paginate($perpage);

            $pagination_full = $query->toArray();

            $pagination = [
                'current_page' => $pagination_full['current_page'],
                'total' => $pagination_full['total'],
                'from' => $pagination_full['last_page'],
                'to' => $pagination_full['to'],
                'prev_page_url' => $pagination_full['prev_page_url'],
                'next_page_url' => $pagination_full['next_page_url'],
                'path' => $pagination_full['path'],
                'per_page' => $perpage,
                //'per_page' => $pagination_full['per_page'],
                'last_page' => $pagination_full['last_page'],
                'first_page_url' => $pagination_full['first_page_url'],
                'last_page_url' => $pagination_full['last_page_url'],
            ];

            $query = $query->map(function ($item) {
                return [
                    'user_id' => $item->user_id,
                    'gender' => $item->gender,
                    'last_name' => $item->last_name,
                    'first_name' => $item->first_name,
                    'birthday' => $item->birthday,
                    'age' => $item->age,
                    'photos' => Photo::getPhotoAvatarByUser($item->user_id),
                    //'videos' => Video::getVideoByUser($item->user_id),
                    'short_bio' => $item->short_bio,
                    //'bio' => $item->bio,
                ];
            });

            $message = [
                'pagination' => $pagination,
                'success' => true,
                'message' => 'successful',
                'data' => $query,
            ];

            return $message;

        }

        public function getDataProfile(int $user_id)
        {

            /*$seeder = new ViewsSeeder();
            $seeder->run();*/

            $query = new ViewBio();
            $query = $query->where('vbios.user_id', '=', $user_id);

            $query = $query->select(
                'vbios.last_name', 'vbios.first_name', 'vbios.age', 'vbios.birthday', 'vbios.short_bio',
                'vbios.gender', 'vbios.user_id', 'vbios.bio', 'vbios.email'
            )
                ->get();

            $query = $query->map(function ($item) {
                return [
                    'user_id' => $item->user_id,
                    'gender' => $item->gender,
                    'last_name' => $item->last_name,
                    'first_name' => $item->first_name,
                    'birthday' => $item->birthday,
                    'age' => $item->age,
                    'photos' => Photo::getPhotoByUser($item->user_id),
                    'videos' => Video::getVideoByUser($item->user_id),
                    'short_bio' => $item->short_bio,
                    'bio' => $item->bio,
                    'email' => $item->email,
                ];
            });

            $message = [
                'success' => true,
                'message' => 'successful',
                'data' => $query,
            ];

            return $message;
        }

        public function getFrontend()
        {
            return view('app');
        }

        public function getGenders()
        {
            return Gender::all();
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }


    }
