    <?php

    namespace App\Http\Controllers;

    use App\Models\Admin\cmdb_movies;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class MovieController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $movies = cmdb_movies::all();
            return view('movies', ['movies' => $movies]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $movies = cmdb_movies::create();
            return view('modify.create', compact('movies'));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $movies = cmdb_movies::all();
            $request->validate([
                'title' => 'required|unique:cmdb_movies|max:255',
            ]);

            //     'title' => 'required|max:255',
            //     // 'actor' => 'required|max:255',
            //     // 'director' => 'required|max:255',
            //     // 'genre' => 'required|max:255',
            //     // Add more fields as needed
            // ]);
            // Create a new movie


            return redirect(route('modify'))->with('success', 'Movie added successfully!');
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
            return view('modify');
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            if (cmdb_movies::where('id', $id)->exists()) {

                $movie = cmdb_movies::find($id);
                $movie->title = is_null($request->title) ? $movie->title : $request->title;
                $movie->description = is_null($request->description) ? $movie->description : $request->description;
                $movie->done = is_null($request->done) ? $movie->done : $request->done;
                $movie->save();
            }

            return "Storing the movies";
            // return view('modify');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            $movie = cmdb_movies::find($id);

            if ($movie) {
                $movie->delete();
                return redirect(route('modify'))->with('success', 'Movie deleted successfully!');
            } else {
                return redirect(route('modify'))->with('error', 'Movie not found!');
            }
        }
    }
