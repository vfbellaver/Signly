<?php

namespace App\Forms;

class CommentForm extends BaseForm
{
	public function team()
	{
		return $this->billboard_face()->team->id;
	}

	public function billboard_face()
	{
		$billboard_face = $this->request->get('billboard_face');
		return \App\Models\BillboardFace::findOrFail($billboard_face['id']);
	}

	public function user()
	{
		if( auth()->check() ) {
			return auth()->user();
		}

		return null;
	}

	public function fromName()
	{
		return $this->request->get('from_name');
	}

	public function comment()
	{
		return $this->request->get('comment');
	}

}
