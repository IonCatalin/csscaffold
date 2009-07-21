<?php defined('BASEPATH') OR die('No direct access allowed.');

/**
 * NestedSelectors
 *
 * @author Anthony Short
 * @dependencies None
 **/
class NestedSelectors extends Plugins
{
	
	/**
	 * The main processing function called by Scaffold. MUST return $css!
	 *
	 * @author Anthony Short
	 * @return $css string
	 */
	function post_process()
	{
		$xml = CSS::to_xml();
		
		$css = "";
		
		foreach($xml->rule as $key => $value)
		{
			$css .= self::parse_rule($value);
		}

		$css = str_replace('#SCAFFOLD-GREATER#', '>', $css);
		$css = str_replace('#SCAFFOLD-QUOTE#', '"', $css);
		$css = str_replace("#SCAFFOLD-IMGDATA-PNG#", "data:image/PNG;", $css);
		$css = str_replace("#SCAFFOLD-IMGDATA-JPG#", "data:image/JPG;", $css);
		
		CSS::$css = $css;
	}
	
	/**
	 * Parse the css selector rule
	 *
	 * @author Anthony Short
	 * @param $rule
	 * @return return type
	 */
	private function parse_rule($rule, $parent = '')
	{
		$css_string = "";
		$property_list = "";

		# Get the selector and store it away
		foreach($rule->attributes() as $type => $value)
		{
			$child = (string)$value;
			
			# If there are multiple parents, split them, and reparse each of them
			if(strstr($parent, ","))
			{
				$parent = explode(",", $parent);
				
				foreach($parent as $parent_key => $parent_value)
				{
					$css_string .= self::parse_rule($rule, trim($parent_value));
				}
			}
			
			# Otherwise, if its NOT a root selector and has parents
			elseif($parent != "")
			{
				# If there are listed parents eg. #id, #id2, #id3
				if(strstr($child, ","))
				{
					$parent = $this->split_children($child, $parent);
				}
				
				# If the child references the parent selector
				elseif (strstr($child, "#SCAFFOLD-PARENT#"))
				{						
					$parent = str_replace("#SCAFFOLD-PARENT#", $parent, $child);	
				}
				
				# Otherwise, do it normally
				else
				{
					$parent = "$parent $child";
				}
			}
			
			# Otherwise it's a root selector with no parents at all
			else
			{
				$parent = $child;
			}
		}
	
		foreach($rule->property as $p)
		{
			$property = (array)$p->attributes(); 
			$property = $property['@attributes'];
			
			$property_list .= $property['name'].":".$property['value'].";";
		}
		
		# Just in case...
		if(!is_array($parent))
		{
			$css_string .= $parent . "{" . $property_list . "}";
		}

		foreach($rule->rule as $inner_rule)
		{
			$css_string .= self::parse_rule($inner_rule, $parent);
		}
		
		return $css_string;
	}
	
	/**
	 * Splits selectors with , and adds the parent to each
	 *
	 * @author Anthony Short
	 * @param $children
	 * @param $parent
	 * @return string
	 */
	private function split_children($children, $parent)
	{
		$children = explode(",", $children);
												
		foreach($children as $key => $child)
		{
			# If the child references the parent selector
			if (strstr($child, "#SCAFFOLD-PARENT#"))
			{
				$children[$key] = str_replace("#SCAFFOLD-PARENT#", $parent, $child);	
			}
			else
			{
				$children[$key] = "$parent $child";
			}
		}
		
		return implode(",",$children);
	}

}