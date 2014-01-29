<?php

class AuthorsController extends BaseController
{
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		try {
			$author = User::findOrFail($id);
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			Session::flash('error-message', 'Sorry, but that isn\'t a valid URL.');
			Log::error($e);
			return Redirect::to('/');
		}

		return View::make('authors.show')
			->with('author', $author)
			->with('styles', $author->styles->sortBy(function($style)
				{
					return $style->title;
				})
			);
	}
}
