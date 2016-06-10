<?php

class Utils{


	public function getDataRequest($data, $request)
	{
		
		$dataF=[];
		$control = 0;
		$total =0;
		$take=0;


		if (isset($request->filter)) {
			$field = $request->filter->filters[0]->field;
			$value = $request->filter->filters[0]->value;
			$newdata=json_encode($data);
			$array = json_decode($newdata, true);
			if($value!=''){
				foreach ($array as $key => $aux) {
					$pos = strpos($aux[$field], $value);
					if($pos !==false){
						$tempArray[$key] = $aux[$field];
					}
				}
				if(isset($tempArray)){
					$finalArray = array();

					foreach($tempArray AS $key => $value) {
						$finalArray[] = $array[$key];
					}
					$data = $finalArray;
				}
			}
		}

		$sort = $this->mergeSortDescriptors($request);

		if (count($sort) > 0) 
		{
			$field = $sort[0]->field;
			$dir = $sort[0]->dir;
			$newdata=json_encode($data);
			$array = json_decode($newdata, true); 
			foreach($array AS $key => $newArray) {
				$tempArray[$key] = $newArray[$field];
			}

			if($dir == 'asc'){
				asort($tempArray);
			}else{
				arsort($tempArray);
			}
			
			$finalArray = array();

			foreach($tempArray AS $key => $value) {
				$finalArray[] = $array[$key];
			}
			$data = $finalArray;  
		}
		if (isset($request->skip) && isset($request->take)) 
		{
			foreach ($data as $aux) 
			{
				if($control>=$request->skip && $take<$request->take){
					array_push($dataF, $aux);
					$take++;
				}
				$control++;
			}
		}
		$total = count($data);

		return ['data'=>$dataF, 'total'=>$total];
	}


	private function mergeSortDescriptors($request) {
		$sort = isset($request->sort) && count($request->sort) ? $request->sort : array();
		$groups = isset($request->group) && count($request->group) ? $request->group : array();

		return array_merge($sort, $groups);
	}



}
?>