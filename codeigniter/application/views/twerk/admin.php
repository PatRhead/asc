<?php include 'adminheader.php'; ?>
<div class="row">
      <div class="large-12 columns">
        <h1>Dashboard</h1>
      </div>
    </div>
 <div class="row">
      <div class="large-12 medium-12 columns">
      	<div class="panel">
	        <h3>Seminars</h3>
		<?php echo $adminSeminars->output; ?>
      	</div>
      </div>
 </div>
 <div class="row">
      <div class="large-12 columns">
      	<div class="panel">
	        <h3>Current Requests</h3>
	        <?php echo $adminRequests->output; ?>
      	</div>
      </div>

      <form>
          <div class="row">
            <div class="large-12 columns">
              <label>Input Label</label>
              <input type="text" placeholder="large-12.columns" />
            </div>
          </div>
          <div class="row">
            <div class="large-4 medium-4 columns">
              <label>Input Label</label>
              <input type="text" placeholder="large-4.columns" />
            </div>
            <div class="large-4 medium-4 columns">
              <label>Input Label</label>
              <input type="text" placeholder="large-4.columns" />
            </div>
            <div class="large-4 medium-4 columns">
              <div class="row collapse">
                <label>Input Label</label>
                <div class="small-9 columns">
                  <input type="text" placeholder="small-9.columns" />
                </div>
                <div class="small-3 columns">
                  <span class="postfix">.com</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="large-12 columns">
              <label>Select Box</label>
              <select>
                <option value="husker">Husker</option>
                <option value="starbuck">Starbuck</option>
                <option value="hotdog">Hot Dog</option>
                <option value="apollo">Apollo</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="large-6 medium-6 columns">
              <label>Choose Your Favorite</label>
              <input type="radio" name="pokemon" value="Red" id="pokemonRed"><label for="pokemonRed">Radio 1</label>
              <input type="radio" name="pokemon" value="Blue" id="pokemonBlue"><label for="pokemonBlue">Radio 2</label>
            </div>
            <div class="large-6 medium-6 columns">
              <label>Check these out</label>
              <input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
              <input id="checkbox2" type="checkbox"><label for="checkbox2">Checkbox 2</label>
            </div>
          </div>
          <div class="row">
            <div class="large-12 columns">
              <label>Textarea Label</label>
              <textarea placeholder="small-12.columns"></textarea>
            </div>
          </div>
        </form>
  
 </div>

<?php include 'footer.php'; ?>
