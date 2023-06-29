<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
// use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Movie;
use Validator;
use App\Http\Resources\Movie as MovieResource;
   
class MovieController extends BaseController
{
    public function __construct(){
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = !empty($request->query('per_page')) ? $request->query('per_page') : 0;
        $page = !empty($request->query('page')) ? $request->query('page') : 0;
        $genre = !empty($request->query('genre')) ? $request->query('genre') : '';
        $director = !empty($request->query('director')) ? $request->query('director') : '';

        $query = Movie::where('status', 'active');

        if(empty($genre) && empty($director) && !empty($perPage) || !empty($page)){            
            $query = Movie::where('status', 'active');
            $movies = $query->paginate($perPage, ['*'], 'page', $page);
            return response()->json($movies);
        }else if(!empty($genre) && empty($director) && !empty($perPage) || !empty($page)){
            $query = Movie::where('status', 'active');

            // Apply genre filter if provided
            if (!empty($genre)) {
                $query->where('genre', 'like', '%' . $genre . '%');
            }

            $movies = $query->paginate($perPage, ['*'], 'page', $page);
            return response()->json($movies);
        }else if(empty($genre) && !empty($director) && !empty($perPage) || !empty($page)){
            $query = Movie::where('status', 'active');

            // Apply director filter if provided
            if (!empty($director)) {
                $query->where('director', 'like', '%' . $director . '%');
            }

            $movies = $query->paginate($perPage, ['*'], 'page', $page);
            return response()->json($movies);
        }else if(!empty($genre) && !empty($director) && !empty($perPage) || !empty($page)){
            $query = Movie::where('status', 'active');

            // Apply genre filter if provided
            if (!empty($genre)) {
                $query->where('genre', 'like', '%' . $genre . '%');
            }

            // Apply director filter if provided
            if (!empty($director)) {
                $query->where('director', 'like', '%' . $director . '%');
            }

            $movies = $query->paginate($perPage, ['*'], 'page', $page);
            return response()->json($movies);
        }else{
            $movies = Movie::where('status', 'active')->get();
            if ($movies->isEmpty()) {
                return response()->json(['message' => 'No active movies found'], 404);
            }        
            return response()->json($movies);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'genre' => 'required|max:100',
            'release_date' => 'required|date_format:Y-m-d',
            'director' => 'required|max:100',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $Movie = Movie::create($input);

        return response()->json(['message' => 'Movie created successfully.','result' =>$Movie], 201);
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::where('status', 'active')->find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }
        return response()->json($movie);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'genre' => 'required|max:100',
            'release_date' => 'required|date_format:Y-m-d',
            'director' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $movie->update($request->all());
        return response()->json(['updated_data' => $movie], 201);
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Movie = Movie::find($id);

        if (!$Movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        // Update the status of the product
        $Movie->status = 'deactive';
        $Movie->save();

        return response()->json(['message' => 'Movie deactivate successfully']);
    }
}