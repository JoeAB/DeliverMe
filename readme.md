This project was developed with a 3 person team for web development course at UMBC.

We had to come up with a concept and build use cases associated with that concept. The
concept my team worked on was a food delivery platform, where restaurants could create
accounts to list their menus online, while customers could create accounts to order from
those menus.

I worked on a team of 3. The other 2 members focused focused on allowing customers and restaurants to
register, while I did  the database design and other parts of the project which includes: 
	functionality to allow restaurant accounts to add items to their menu, 
	functionality to allow customers to order items, 
	functionality to allow restaurants to view order details and statuses, 
	functionality to search for the customers,
	design of the main menu page,
	and handled the session handling and integration of the other parts.
	
The project itself had a few parts that are not optimal for a real world web application due
to restrictions of working with the school's web and database server. Most notably is how we handled
picture uploads. Due to security settings, we could not upload the images to server and be able to easily
point to them via an HTML img src path. This is what prompted me to include the php function that converted
the image data to a mime format in order to render it in the web page. Obviously this causes a performance
hit, but was necessary to get the final product I wanted for when we presented the application at the 
end of the class. 