exports.isValidJSON = function(str)
{
  try
  {
    parsed = JSON.parse(str);
  }
  catch(e)
  {
    return false;
  }

  return parsed;
};
