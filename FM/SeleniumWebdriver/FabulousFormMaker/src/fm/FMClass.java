package fm;

import java.util.concurrent.TimeUnit;

import org.openqa.selenium.By;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.support.ui.WebDriverWait;


public class FMClass {

	/**
	 * Running a smoke test of FabulousFormMaker
	 */
	public static void main(String[] args) 
	{
		
		// Create a new instance of the Firefox driver
		FirefoxDriver driver = new FirefoxDriver();
		// Navigate to URL
		driver.get("http://ellytronic.media/projects/parina/wp-login.php?");
		// Maximize the window.
		driver.manage().window().maximize();
		// Enter username
		driver.findElement(By.id("user_login")).sendKeys("parinam");
		// Enter Password
		driver.findElement(By.id("user_pass")).sendKeys("9%ad:2J8yx!ts|R");
		// Click on Log In
		driver.findElement(By.id("wp-submit")).click();
		// Wait For Page To Load
		driver.manage().timeouts().implicitlyWait(60, TimeUnit.SECONDS);
		// Navigate to Contact Form Tab
		driver.get("http://ellytronic.media/projects/parina/wp-admin/admin.php?page=etm-contact");
		// Address the contact form to the following name
		//driver.findElement(By.id("etm_recipient_name")).sendKeys("Parina");
		// Send the contact form to this email address:
		//driver.findElement(By.id("etm_recipient_email")).sendKeys("parina.madaan@gmail.com");
		// Save the above settings
		driver.findElement(By.id("etm_submit_settings")).click();
		// Create form in Form Editor (Single-Line Text Box)
		driver.findElement(By.id("etm_add_selector")).findElement(By.cssSelector("option[value='text']")).click();
		// Text to print before this single line text box
		driver.findElement(By.id("etm_namer")).sendKeys("Name");
		// Make the field as required
		driver.findElement(By.id("etm_required")).click();
		// Click on Finish this element and add to form
		driver.findElement(By.id("etm_addElement")).click();
		// Select 'Selection Box'
		driver.findElement(By.id("etm_add_selector")).findElement(By.cssSelector("option[value='select']")).click();
		// Text to print before this drop down select box
		driver.findElement(By.id("etm_namer")).sendKeys("Age");
		// Make the field as required
		driver.findElement(By.id("etm_required")).click();
		// Add values to drop down list
		driver.findElement(By.id("etm_optioner")).sendKeys("1");
		// Add this option to My Select Box
		driver.findElement(By.xpath(".//*[@id='etm_work_area']/p[3]/a")).click();
		// Add another value in the drop down
		driver.findElement(By.id("etm_optioner")).sendKeys("2");
		// Add this option to My Select Box
		driver.findElement(By.xpath(".//*[@id='etm_work_area']/p[3]/a")).click();
		// Click on Finish this element and add to form
		driver.findElement(By.id("etm_addElement")).click();
		// Create form in Form Editor (Large Text Box)
		driver.findElement(By.id("etm_add_selector")).findElement(By.cssSelector("option[value='textarea']")).click();
		// Text to print before this large text box
		driver.findElement(By.id("etm_namer")).sendKeys("LastName");
		// Make the field as required
		driver.findElement(By.id("etm_required")).click();
		// Click on Finish this element and add to form
		driver.findElement(By.id("etm_addElement")).click();
		// Create form in Form Editor (Password Text Box)
		driver.findElement(By.id("etm_add_selector")).findElement(By.cssSelector("option[value='password']")).click();
		// Text to print before this large text box
		driver.findElement(By.id("etm_namer")).sendKeys("Enter Password");
		// Make the field as required
		driver.findElement(By.id("etm_required")).click();
		// Click on Finish this element and add to form
		driver.findElement(By.id("etm_addElement")).click();
		// Create form in Form Editor (Radio Box)
		driver.findElement(By.id("etm_add_selector")).findElement(By.cssSelector("option[value='radio']")).click();
		// Text to print before this Radio box
		driver.findElement(By.id("etm_namer")).sendKeys("Country");
		// Make the field as required
		driver.findElement(By.id("etm_required")).click();
		// Label for this choice
		driver.findElement(By.id("etm_optioner")).sendKeys("India");
		// Add this option to My Select Box
		driver.findElement(By.xpath(".//*[@id='etm_work_area']/p[3]/a")).click();
		// Label for this choice
		driver.findElement(By.id("etm_optioner")).sendKeys("UK");
		// Add this option to My Select Box
		driver.findElement(By.xpath(".//*[@id='etm_work_area']/p[3]/a")).click();
		// Click on Finish this element and add to form
		driver.findElement(By.id("etm_addElement")).click();
		// Create form in Form Editor (Check Boxes)
		driver.findElement(By.id("etm_add_selector")).findElement(By.cssSelector("option[value='checkbox']")).click();
		// Text to print before this Check Boxes
		driver.findElement(By.id("etm_namer")).sendKeys("Sex");
		// Label for this choice
		driver.findElement(By.id("etm_optioner")).sendKeys("Male");
		// Add this option to check box
		driver.findElement(By.xpath(".//*[@id='etm_work_area']/p[2]/a")).click();
		// Label for this choice
		driver.findElement(By.id("etm_optioner")).sendKeys("Female");
		// Add this option to check box
		driver.findElement(By.xpath(".//*[@id='etm_work_area']/p[2]/a")).click();
		// Click on Finish this element and add to form
		driver.findElement(By.id("etm_addElement")).click();
		// Check for delete functionality
		driver.findElement(By.xpath(".//*[@id='etm_element_5']/p/a")).click();
		// Save form
		driver.findElement(By.xpath(".//*[@id='etm_submit']")).click();
	
		
	}
	

}
