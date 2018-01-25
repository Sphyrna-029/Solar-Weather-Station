 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Add a new node</h1>
          <style>
            #container {
                min-width: 310px;
                max-width: 800px;
                height: 400px;
                margin: 0 auto
            }
          </style>
          <div id="formcontainer">
            <div class="container">
              <h3>Node details</h3>
              <p>Please enter a node name and its respective latitude and longitude.</p>

              <form>
                <div class="input-group">
                  <span class="input-group-addon">Node Name</span>
                  <input id="msg" type="text" class="form-control" name="Node Name" placeholder="Node1">
                </div>
                <br>
                <div class="input-group">
                  <span class="input-group-addon">Latitude  </span>
                  <input id="msg" type="text" class="form-control" name="latitude" placeholder="">
                </div>
                <div class="input-group">
                  <span class="input-group-addon">Longitude</span>
                  <input id="msg" type="text" class="form-control" name="longitude" placeholder="">
                </div>
                <br>
                <p>Save this key! You cannot generate it again.</p>
                <div class="alert alert-info">
                <strong>API Key:   </strong>Cmf6jQIG4MOXeUldbArgVg93</div>
                <br>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>
              <br>
