<script>
 def create_data():
  """Creates the data."""
  data = {}
  data['API_key'] = AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o&callback=initMap&v=weekly
  data['addresses'] = ["30.588306869629527%2C31.47918156839698", #driver #12 current loca
                       "30.073040504782547%2C31.345765282277267", #order 13 pickup loc
                       "30.068329781020058%2C31.323759091237868", #order 13 dropoff loc
                       "30.073040504782547%2C31.345765282277267", #order 14 pickup loc
                       "30.062493604295614%2C31.34477108388055", #order 14 dropoff loc
                       "30.073040504782547%2C31.345765282277267", #order 15 pickup loc
                       "30.09912973586751%2C31.315054495649424", #order 15 dropoff loc
                       "30.584087371098757%2C31.50439621285545",  #order 16 pickup loc
                       "30.596311789481327%2C31.488618697512486", #order 16 dropoff loc
                       "30.584087371098757%2C31.50439621285545",  #order 17 pickup loc
                       "30.548610813018943%2C31.834700566824836"] #order 17 dropoff loc
  return data

def create_distance_matrix(deliverers_location, orders):
  data = create_data(deliverers_location, orders)
  addresses = data["addresses"]
  API_key = data["API_key"]
  # Distance Matrix API only accepts 100 elements per request, so get rows in multiple requests.
  max_elements = 100
  num_addresses = len(addresses)
  # Maximum number of rows that can be computed per request.
  max_rows = max_elements // num_addresses
  # num_addresses = q * max_rows + r (q = 2 and r = 4 in this example).
  q, r = divmod(num_addresses, max_rows)
  dest_addresses = addresses
  distance_matrix = []
  # add the zeros row at the beginning of the matrix >> end node distance 
  end_node = []
  for i in range(len(addresses)+1):
    end_node.append(0)
  distance_matrix.append(end_node)
  # Send q requests, returning max_rows rows per request.
  for i in range(q):
      origin_addresses = addresses[i * max_rows: (i + 1) * max_rows]
      response = send_request(origin_addresses, dest_addresses, API_key)
      distance_matrix += build_distance_matrix(response)

  # Get the remaining remaining r rows, if necessary.
  if r > 0:
      origin_addresses = addresses[q * max_rows: q * max_rows + r]
      response = send_request(origin_addresses, dest_addresses, API_key)
      distance_matrix += build_distance_matrix(response)
  
  # Add a row of zeros and a zero at the start of each row
  dist_matrix = []
  for row in distance_matrix:
    if len(row) == len(addresses)+1: # check if the zero is already added to the beginning of the row
      dist_matrix.append(row)        # just add row to the new list
    elif len(row) == len(addresses): 
      row.insert(0,0)                # insert zero at the beginning and append row
      dist_matrix.append(row)
  distance_matrix = dist_matrix
  return distance_matrix
  
  </script>