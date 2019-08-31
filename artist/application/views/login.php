
   <h2 class="header1">Login Page</h2>
   <?php echo validation_errors();?>  
   <?php echo form_open('admin_login');?>
   <label for="username">Username:</label>
   <input type="input" name="username"/><br>
   <label for="password">Password:</label>
   <input type="password" name="password"/>
   <input type="submit" name="submit" value="Password Login" />
   <input type="hidden" name="info" value="logginset"/>
   </form>
   <?php //if($title == "Login2") echo "password: " . $password . ",username:" . $username;?>
</body>
</html>