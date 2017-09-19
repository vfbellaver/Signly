<?php

namespace App\Forms;

class BillboardFaceForm extends BaseForm
{
	public function unique()
	{
		$unique = (object) $this->request->get('unique');
		return \App\Models\Unique::findOrFail($unique->id);
	}

	public function height()
	{
		return $this->request->get('height');
	}

	public function width()
	{
		return $this->request->get('width');
	}

	public function reads()
	{
		return $this->request->get('reads');
	}

	public function label()
	{
		return $this->request->get('label');
	}

	public function signType()
	{
		return $this->request->get('sign_type');
	}

	public function hardCost()
	{
		return $this->request->get('hard_cost');
	}

	public function monthlyImpressions()
	{
		return $this->request->get('monthly_impressions');
	}

	public function notes()
	{
		return $this->request->get('notes');
	}

	public function maxAds()
	{
		return $this->request->get('max_ads');
	}

	public function duration()
	{
		return $this->request->get('duration');
	}

	public function photo()
	{
		return $this->request->get('photo');
	}

	public function isIluminated()
	{
		return $this->request->get('is_iluminated');
	}

	public function billboard()
	{
		$billboard = (object) $this->request->get('billboard');
		return \App\Models\Billboard::findOrFail($billboard->id);
	}


}
