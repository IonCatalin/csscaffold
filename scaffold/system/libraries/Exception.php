<?php

/**
 * Scaffold_Exception
 *
 * Class for handling errors and exceptions
 * 
 * @author your name
 */
class Scaffold_Exception
{
	/**
	 * Handles Exceptions
	 *
	 * @param   integer|object  exception object or error code
	 * @param   string          error message
	 * @param   string          filename
	 * @param   integer         line number
	 * @return  void
	 */
	public static function exception_handler($exception, $message = NULL, $file = NULL, $line = NULL)
	{
		try
		{
			# PHP errors have 5 args, always
			$PHP_ERROR = (func_num_args() === 5);
	
			# Test to see if errors should be displayed
			if ($PHP_ERROR AND error_reporting() === 0)
				die;
				
			# Error handling will use exactly 5 args, every time
			if ($PHP_ERROR)
			{
				$code     = $exception;
				$type     = 'PHP Error';
			}
			else
			{
				$code     = $exception->getCode();
				$type     = get_class($exception);
				$message  = $exception->getMessage();
				$file     = $exception->getFile();
				$line     = $exception->getLine();
			}

			if(is_numeric($code))
			{
				//$codes = self::lang('errors');
	
				if (!empty($codes[$code]))
				{
					list($level, $error, $description) = $codes[$code];
				}
				else
				{
					$level = 1;
					$error = $PHP_ERROR ? 'Unknown Error' : get_class($exception);
					$description = '';
				}
			}
			else
			{
				// Custom error message, this will never be logged
				$level = 5;
				$error = $code;
				$description = '';
			}
			
			// Remove the self::config('core.path.docroot') from the path, as a security precaution
			$file = str_replace('\\', '/', realpath($file));
			$file = preg_replace('|^'.preg_quote($_SERVER['DOCUMENT_ROOT']).'|', '', $file);

			if($PHP_ERROR)
			{
				$description = 'An error has occurred which has stopped Scaffold';
	
				if (!headers_sent())
				{
					# Send the 500 header
					header('HTTP/1.1 500 Internal Server Error');
				}
			}
			else
			{
				if (method_exists($exception, 'sendHeaders') AND !headers_sent())
				{
					# Send the headers if they have not already been sent
					$exception->sendHeaders();
				}
			}
			
			if ($line != FALSE)
			{
				// Remove the first entry of debug_backtrace(), it is the exception_handler call
				$trace = $PHP_ERROR ? array_slice(debug_backtrace(), 1) : $exception->getTrace();

				// Beautify backtrace
				$trace = self::backtrace($trace);
				
			}
			
			require CSScaffold::find_file('Exception.php','views',true);
			
			
			
			# Turn off error reporting
			error_reporting(0);
			exit;
		}
		catch(Exception $e)
		{
			die('Fatal Error: '.$e->getMessage().' File: '.$e->getFile().' Line: '.$e->getLine());
		}
	}

	/**
	 * Displays nice backtrace information.
	 * @see http://php.net/debug_backtrace
	 *
	 * @param   array   backtrace generated by an exception or debug_backtrace
	 * @return  string
	 */
	public static function backtrace($trace)
	{
		if ( ! is_array($trace))
			return;

		// Final output
		$output = array();

		foreach ($trace as $entry)
		{
			$temp = '<li>';
			$temp .= '<pre>';
			
			if (isset($entry['file']))
			{
				$file = preg_replace('!^'.preg_quote( $_SERVER['DOCUMENT_ROOT'] ).'!', '', $entry['file']);
				$line = (string)$entry['line'];

				$temp .= "<tt>{$file}<strong>[{$line}]:</strong></tt>";
			}

			if (isset($entry['class']))
			{
				// Add class and call type
				$temp .= $entry['class'].$entry['type'];
			}

			// Add function
			$temp .= $entry['function'].'( ';

			// Add function args
			if (isset($entry['args']) AND is_array($entry['args']))
			{
				// Separator starts as nothing
				$sep = '';

				while ($arg = array_shift($entry['args']))
				{
					if(is_object($arg))
						$arg = $trace;
					
					if (is_string($arg) AND is_file($arg))
					{
						// Remove docroot from filename
						$arg = preg_replace('!^'.preg_quote($_SERVER['DOCUMENT_ROOT']).'!', '', $arg);
					}

					$temp .= $sep.htmlspecialchars((string)$arg, ENT_QUOTES, 'UTF-8');

					// Change separator to a comma
					$sep = ', ';
				}
			}

			$temp .= ' )</pre></li>';

			$output[] = $temp;
		}

		return '<ul class="backtrace">'.implode("\n", $output).'</ul>';
	}
}