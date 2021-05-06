<?php

    namespace App\Http\Controllers\Api\v1;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;

    class UploadController extends Controller
    {


        public function uploadData(Request $request)
        {
            $req = $request->all();

            $file_name = 'uploaded_filename' . date('Y_m_d__H_i_s') . '.jpg';
            $path = '/upload/images/2021/04/07/' . $file_name;

            $user_id = $req['data']['user'];

            $base64_image = $req['data']['image']; // your base64 encoded
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $file_data) = explode(',', $file_data);
            //$imageName = str_random(10).'.'.'png';
            $imageName = $path;
            Storage::disk('local')->put($imageName, base64_decode($file_data));


            $result = 1;

            return $result;

        }

        public function getAllowedMimeImages()
        {
            return [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
            ];

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
