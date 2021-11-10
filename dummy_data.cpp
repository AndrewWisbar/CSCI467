#include <iostream>
#include <iomanip>
#include <cstdlib>
#include <string>

using std::cin;
using std::cout;
using std::endl;
using std::string;
using std::setw;
using std::right;
using std::left;
using std::to_string;
int main () 
{
    for(int i = 0; i < 150; i++) {
        cout << "INSERT INTO InventoryDatabase (ItemID, Quantity) VALUES (" << i << ", " << std::rand() % 1000 + 1 << ");\n";    
    }
    return 0;
}