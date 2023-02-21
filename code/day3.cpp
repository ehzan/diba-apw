#include <iostream>
#include <fstream>
#include <sstream>
#include <string>
#include <cctype>
#include <vector>
#include <regex>
#include <numeric>
using namespace std;

string read_file(const string &input_file)
{
    ifstream file(input_file);
    stringstream buffer;
    buffer << file.rdbuf();
    file.close();
    return buffer.str();
}

string rtrim(string &str)
{
    int last = str.find_last_not_of(" \t\r\n");
    str.erase(last + 1);
    return str;
}

vector<string> split(const string &str, const regex &delimiter)
{
    sregex_token_iterator itr(str.begin(), str.end(), delimiter, -1);
    const sregex_token_iterator end;
    vector<string> parts(itr, end);
    return parts;
}

int priority(const char ch)
{
    return islower(ch) ? (int(ch) - int('a') + 1) : (int(ch) - int('A') + 27);
}

int puzzle5(string input_file)
{
    string data = read_file(input_file);
    data = rtrim(data);
    vector<string> rucksacks = split(data, regex("\r?\n"));
    vector<char> intersections;
    int middle;
    string part1, part2;
    for (const string rucksack : rucksacks)
    {
        middle = rucksack.length() / 2;
        part1 = rucksack.substr(0, middle);
        part2 = rucksack.substr(middle, middle);
        for (char ch : part1)
            if (part2.find(ch) != string::npos)
            {
                intersections.push_back(ch);
                break;
            }
    }
    int sum = accumulate(intersections.begin(), intersections.end(), 0,
                         [](int previousResult, char ch)
                         { return previousResult + priority(ch); });
    return sum;
}

int puzzle6(string input_file)
{
    string data = read_file(input_file);
    data = rtrim(data);
    vector<string> rucksacks = split(data, regex("\r?\n"));
    vector<char> intersections;
    string rucksack1, rucksack2, rucksack3;
    for (int i = 0; i < rucksacks.size(); i += 3)
    {
        for (char ch : rucksacks[i])
            if (rucksacks[i + 1].find(ch) != string::npos &&
                rucksacks[i + 2].find(ch) != string::npos)
            {
                intersections.push_back(ch);
                break;
            }
    }
    int sum = accumulate(intersections.begin(), intersections.end(), 0,
                         [](int previousResult, char ch)
                         { return previousResult + priority(ch); });
    return sum;
}

int main(void)
{
    cout << "Day #3, part one: " << puzzle5("input/day3.txt") << endl;
    cout << "Day #3, part two: " << puzzle6("input/day3.txt") << endl;
}