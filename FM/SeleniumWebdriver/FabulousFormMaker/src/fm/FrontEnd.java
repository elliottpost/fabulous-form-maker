package fm;

import org.openqa.selenium.By;
import org.openqa.selenium.firefox.FirefoxDriver;

public class FrontEnd {

	/**
	 * Running a smoke test for Front End
	 */
	public static void main(String[] args) {
		
				// Create a new instance of the Firefox driver
				FirefoxDriver driver = new FirefoxDriver();
				// Navigate to FrontEnd URL
				driver.get("http://ellytronic.media/projects/parina/contact/");
				// Maximize the window.
				driver.manage().window().maximize();
				// Select Age from drop down
				driver.findElement(By.xpath(".//*[@id='field_0']")).findElement(By.cssSelector("option[value='2']")).click();
				// Enter Password
				driver.findElement(By.xpath(".//*[@id='field_1']")).sendKeys("parina");
				// Select Radio Button
				driver.findElement(By.xpath(".//*[@id='ellytronic-contact']/input[5]")).click();
				// Select check box
				driver.findElement(By.xpath(".//*[@id='ellytronic-contact']/input[8]")).click();
				// Enter first name
				driver.findElement(By.xpath(".//*[@id='field_4']")).sendKeys("Elliott");
				// Enter last name
				driver.findElement(By.xpath(".//*[@id='field_5']")).sendKeys("Post");
				// Click on Submit button
				driver.findElement(By.xpath(".//*[@id='etm_submit']")).click();
				// Thank you message is displayed after click on Submit Button
	}

}
