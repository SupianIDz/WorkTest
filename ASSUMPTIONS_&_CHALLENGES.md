
## Assumptions & Considerations

I assumed in this test that this reservation application is intended for
single restaurant, not multiple restaurants in one application due to the availability of time for this test.

Customers can order a table along with the available menu with a maximum period of 14 days from the day the order occurs to make things easier for restaurants

Because there is no clear policy regarding the position of the table ordered, the table ordered by the user is determined randomly by the system with the parameters of time
availability and seat capacity requested at that table.

## Challenges Faced and How to Overcome Problems

### 1. Time Sharing

The problem faced is the division of booking time periods which may be unpredictable, for example a customer may only want to book a table for 90 minutes or a customer may want no
time limit, just the start time.

This second customer will cause chaos in the division of time at the table ordered and will affect subsequent table orders, because there is no deadline for using the table,
especially in small restaurants where the number of tables is limited, this will have a big impact.

This problem can be overcome by requiring prospective customers to set the start and end times of their reservations, here I ignore the time for the waiters to clean up occupied
tables.

### 2. Table Availability

In general, when booking restaurant tables online, you can usually choose the desired table position, similar to when you book airplane seats. Restaurant booking platforms often
display a table map with the option to select an available table, be it indoors, outdoors, near a window, or in a specific area of the restaurant. Some restaurants may also provide
the option to select table positions based on specific preferences, such as seats near the kitchen or near the bar.

However, there are also some restaurants that may use a random or "random" table placement system depending on the policy and capacity of the restaurant at that time. This is
especially true for very busy restaurants or when you make your order at a particularly busy time.

Here I chose the second situation, where tables will be selected randomly based on table availability and capacity.

### 3. Race Condition

There are several ways to overcome Race Conditions, such as Pessimistic Locking, Atomic Locks or with a Queue.

I didn't choose Queue because Queue will cause delays in requests and Deadlock or Livelock when two or more processes are stuck waiting for each other to release the resources they
have, while livelock occurs when the processes are constantly "spinning" without making progress which are actually.

I also don't choose Pessimistic Locking because this approach can reduce system scalability and performance, especially if there are many transactions trying to lock the same
resource simultaneously.

I chose Atomic Lock with the following considerations:

Atomic Locks ensure that booking-related operations, such as checking table availability and applying bookings, are executed as an inseparable unit. This means that if there is an
interruption or failure in one of the operational steps, the system will return to its original state, thereby minimizing the risk of errors or inconsistencies in order data.

Atomic Locks also help in controlling concurrency of access to resources. By implementing the correct atomicity mechanisms, you can ensure that only one process or transaction can
access and modify a table's availability state at a time. This reduces the risk of race conditions and results in more reliable and consistent operation.

Scalability: Atomic Locks are generally more acceptable in environments that require high scalability because they avoid the use of more aggressive locking as in Pessimistic
Locking. By using an atomic approach, we can optimize your system performance without sacrificing data reliability and consistency.
