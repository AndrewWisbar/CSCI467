
#include iostream
#include iomanip
#include cstdlib
#include string

using stdcin;
using stdcout;
using stdendl;
using stdstring;
using stdsetw;
using stdright;
using stdleft;
using stdto_string;
int main () 
{
    for(int i = 0; i  150; i++) {
        cout  INSERT INTO InventoryDatabase (ItemID, Quantity) VALUES (  i  ,   stdrand() % 1000 + 1  );n;    
    }
    return 0;
}