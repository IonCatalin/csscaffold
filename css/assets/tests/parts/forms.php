<?php include '../includes/head.php'; ?>

<body id="tests">
	
	<div id="page" class="layout-blog">
		<div id="primary-content">
		
			<form id="form-id" action="" method="get">
		
				<fieldset class="block">
					<legend>Fieldset 1 - class="block"</legend>
											
						<div class="form-control">
							<label for="longtext">Textarea</label>
							<p class="formtip above">This is a form tip</p>
							<textarea id="longtext" name="longtext" rows="10" cols="10">Textarea content</textarea>
						</div>
						
			<div class="checkboxes">
				<p class="label">Choose some</p>
				<p class="formtip">This is a form tip</p>
				<ul>
					<li class="checkbox">
						<label for="choice">
							<input type="checkbox" id="choice" name="choice" value="yes" />
							This is the name
						</label>
					</li>
					<li class="checkbox">
						<label for="choice2">
							<input type="checkbox" id="choice2" name="choice2" value="yes" />
							This is the name
						</label>
					</li>
					<li class="checkbox">
						<label for="choice3">
							<input type="checkbox" id="choice3" name="choice3" value="yes" />
							This is the name
						</label>
					</li>
				</ul>	
			</div>
			<input type="hidden" name="redirect" value="http://www.opera.com" />
			<div class="radio">
				<p class="label">Choose one</p>
				<p class="formtip">This is a form tip</p>
				<ul>
					<li>
						<input type="radio" name="radiogroup" id="radiobutton" value="thisisthevalue" />
						<label for="radiobutton">This is the value</label>
					</li>
				</ul>
			</div>
			<div class="select">
				<label for="town">Select your Town</label>
				<p class="formtip">This is a form tip</p>
				<select id="town">
					<option value="">Please Select One</option>
					<option value="hoha">Ho Ha</option>
					<option value="hoha">Ho Ha</option>
					<option value="hoha">Ho Ha</option>
					<option value="hoha">Ho Ha</option>
				</select>
			</div>
			<div class="buttons">
				<button type="submit" id="submit" name="submit">Submit</button>
				<button type="reset" id="reset" name="reset">Reset</button>
				<p class="formtip">This is a form tip</p>
			</div><div class="upload">
					<label for="file">Upload Image</label>
					<p class="formtip">This is a form tip</p>
					<input type="file" id="file" name="file" value="" />
			</div>
				</fieldset>
			</form>


			<form id="form-id-2" action="" method="get">
		
				<fieldset class="inline">
					<legend>Fieldset 1 - class="inline"</legend>
		
						<div class="text">
				<label for="name">Name</label>
				<input type="text" id="name" name="name" value="" />
				<p class="formtip">This is a form tip</p>
			</div>
			<div class="textarea">
				<label for="longtext">Textarea</label>
				<p class="formtip above">This is a form tip</p>
				<textarea id="longtext" name="longtext" rows="10" cols="10">Textarea content</textarea>
			</div>
			<div class="checkboxes">
				<p class="label">Choose some</p>
				<p class="formtip">This is a form tip</p>
				<ul>
					<li class="checkbox">
						<label for="choice">
							<input type="checkbox" id="choice" name="choice" value="yes" />
							This is the name
						</label>
					</li>
					<li class="checkbox">
						<label for="choice2">
							<input type="checkbox" id="choice2" name="choice2" value="yes" />
							This is the name
						</label>
					</li>
					<li class="checkbox">
						<label for="choice3">
							<input type="checkbox" id="choice3" name="choice3" value="yes" />
							This is the name
						</label>
					</li>
				</ul>	
			</div>
			<input type="hidden" name="redirect" value="http://www.opera.com" />
			<div class="radio">
				<p class="label">Choose one</p>
				<p class="formtip">This is a form tip</p>
				<ul>
					<li>
						<input type="radio" name="radiogroup" id="radiobutton" value="thisisthevalue" />
						<label for="radiobutton">This is the value</label>
					</li>
				</ul>
			</div>
			<div class="select">
				<label for="town">Select your Town</label>
				<p class="formtip">This is a form tip</p>
				<select id="town">
					<option value="">Please Select One</option>
					<option value="hoha">Ho Ha</option>
					<option value="hoha">Ho Ha</option>
					<option value="hoha">Ho Ha</option>
					<option value="hoha">Ho Ha</option>
				</select>
			</div>
			<div class="buttons">
				<button type="submit" id="submit" name="submit">Submit</button>
				<button type="reset" id="reset" name="reset">Reset</button>
				<p class="formtip">This is a form tip</p>
			</div><div class="upload">
					<label for="file">Upload Image</label>
					<p class="formtip">This is a form tip</p>
					<input type="file" id="file" name="file" value="" />
			</div>
				</fieldset>
			</form>
			
		</div>
		
		
	
</div>

	<?php include '../includes/nav.php'; ?>
	
	
</body>
</html>
